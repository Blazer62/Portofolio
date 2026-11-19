<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class Media
{
    /**
     * Simpan file unggahan:
     * 1. Jika direktori fisik public/uploads dapat ditulis (misal di localhost), simpan sebagai file fisik.
     * 2. Jika di lingkungan serverless (Vercel) di mana filesystem bersifat read-only, konversi otomatis
     *    menjadi Data URL (base64) yang tersimpan langsung di database secara permanen.
     */
    public static function store(?UploadedFile $file, string $folder = 'uploads'): ?string
    {
        if (! $file || ! $file->isValid()) {
            return null;
        }

        // Cek apakah direktori fisik public/uploads dapat dibuat dan ditulis
        $targetDir = public_path($folder);
        $canWrite = false;

        try {
            if (! is_dir($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $canWrite = is_dir($targetDir) && is_writable($targetDir);
        } catch (\Throwable $e) {
            $canWrite = false;
        }

        // Jika filesystem fisik dapat ditulis (misal pengembangan lokal):
        if ($canWrite) {
            try {
                $base = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) ?: 'file';
                $name = $base.'-'.Str::random(8).'.'.strtolower($file->getClientOriginalExtension());
                $file->move($targetDir, $name);

                return $folder.'/'.$name;
            } catch (\Throwable $e) {
                // Jika gagal move, lanjut ke fallback Data URL
            }
        }

        // Fallback untuk Vercel / lingkungan serverless read-only:
        // Konversi file unggahan menjadi Data URL (base64)
        try {
            $mime = $file->getMimeType() ?: 'image/jpeg';
            $realPath = $file->getRealPath();

            if ($realPath && file_exists($realPath)) {
                $content = @file_get_contents($realPath);

                if ($content !== false) {
                    // Jika file berupa gambar dan ekstensi GD tersedia, optimalkan ukuran dimensi gambar
                    if (str_starts_with($mime, 'image/') && function_exists('imagecreatefromstring')) {
                        $optimized = self::optimizeImage($content, $mime);
                        if ($optimized) {
                            return 'data:image/jpeg;base64,'.base64_encode($optimized);
                        }
                    }

                    return 'data:'.$mime.';base64,'.base64_encode($content);
                }
            }
        } catch (\Throwable $e) {
            //
        }

        return null;
    }

    /**
     * Kompres dan optimalkan dimensi gambar jika ekstensi GD tersedia.
     */
    private static function optimizeImage(string $binary, string $mime): ?string
    {
        try {
            $img = @imagecreatefromstring($binary);
            if (! $img) {
                return null;
            }

            $width = imagesx($img);
            $height = imagesy($img);

            $maxWidth = 1200;
            $maxHeight = 1200;

            if ($width > $maxWidth || $height > $maxHeight) {
                $ratio = min($maxWidth / $width, $maxHeight / $height);
                $newWidth = (int) round($width * $ratio);
                $newHeight = (int) round($height * $ratio);

                $resized = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($resized, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagedestroy($img);
                $img = $resized;
            }

            ob_start();
            imagejpeg($img, null, 82);
            $output = ob_get_clean();
            imagedestroy($img);

            return $output ?: null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Ubah nilai path/URL yang tersimpan menjadi URL yang bisa dipakai <img src> atau <a href>.
     */
    public static function url(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', 'data:', '/'])) {
            return $path;
        }

        return asset($path);
    }
}
