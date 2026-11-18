<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class Media
{
    /**
     * Simpan file unggahan ke public/uploads dan kembalikan path relatifnya.
     * Path relatif membuat gambar ikut ter-deploy bersama project.
     */
    public static function store(?UploadedFile $file, string $folder = 'uploads'): ?string
    {
        if (! $file) {
            return null;
        }

        $base = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) ?: 'file';
        $name = $base.'-'.Str::random(8).'.'.strtolower($file->getClientOriginalExtension());

        $file->move(public_path($folder), $name);

        return $folder.'/'.$name;
    }

    /**
     * Ubah nilai path/URL yang tersimpan menjadi URL yang bisa dipakai <img src>.
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
