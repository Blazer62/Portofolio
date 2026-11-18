<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Support\Media;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Simpan testimoni baru yang dikirim oleh publik / pengunjung.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:guru,teman,pengguna,plk',
            'message' => 'required|string|max:1000',
            'photo_file' => 'nullable|image|max:3072',
        ]);

        $data['role'] = null;

        if ($request->hasFile('photo_file')) {
            $data['photo'] = Media::store($request->file('photo_file'));
        }

        $data['sort_order'] = 0;

        Testimonial::create($data);

        return back()
            ->with('success', 'Testimoni kamu berhasil dikirim dan ditampilkan. Terima kasih banyak atas dukungannya!')
            ->withFragment('testimonials');
    }
}
