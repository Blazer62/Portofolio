<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Support\Media;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.testimonials.index', [
            'testimonials' => Testimonial::orderBy('type')->orderBy('sort_order')->get(),
            'editing' => $request->filled('edit') ? Testimonial::find($request->integer('edit')) : null,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['photo'] = Media::store($request->file('photo_file'));

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $this->validated($request);

        if ($upload = Media::store($request->file('photo_file'))) {
            $data['photo'] = $upload;
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'type' => 'required|in:guru,teman,pengguna,plk',
            'message' => 'required|string',
            'photo_file' => 'nullable|image|max:4096',
            'sort_order' => 'nullable|integer|min:0',
        ]);
    }
}
