<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.educations.index', [
            'educations' => Education::orderBy('sort_order')->get(),
            'editing' => $request->filled('edit') ? Education::find($request->integer('edit')) : null,
        ]);
    }

    public function store(Request $request)
    {
        Education::create($this->validated($request));

        return redirect()->route('admin.educations.index')->with('success', 'Riwayat pendidikan berhasil ditambahkan.');
    }

    public function update(Request $request, Education $education)
    {
        $education->update($this->validated($request));

        return redirect()->route('admin.educations.index')->with('success', 'Riwayat pendidikan berhasil diperbarui.');
    }

    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()->route('admin.educations.index')->with('success', 'Riwayat pendidikan berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'level' => 'required|string|max:100',
            'institution' => 'required|string|max:255',
            'major' => 'nullable|string|max:255',
            'start_year' => 'nullable|string|max:10',
            'end_year' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);
    }
}
