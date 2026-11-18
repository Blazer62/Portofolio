<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Support\Media;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.certificates.index', [
            'certificates' => Certificate::orderByDesc('year')->orderBy('sort_order')->get(),
            'editing' => $request->filled('edit') ? Certificate::find($request->integer('edit')) : null,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['image'] = Media::store($request->file('image_file'));
        $data['file'] = Media::store($request->file('certificate_file'));

        Certificate::create($data);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil ditambahkan.');
    }

    public function update(Request $request, Certificate $certificate)
    {
        $data = $this->validated($request);

        if ($upload = Media::store($request->file('image_file'))) {
            $data['image'] = $upload;
        }

        if ($upload = Media::store($request->file('certificate_file'))) {
            $data['file'] = $upload;
        }

        $certificate->update($data);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil diperbarui.');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'image_file' => 'nullable|image|max:4096',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:8192',
            'sort_order' => 'nullable|integer|min:0',
        ]);
    }
}
