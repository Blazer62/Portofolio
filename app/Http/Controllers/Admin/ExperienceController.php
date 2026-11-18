<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.experiences.index', [
            'experiences' => Experience::orderBy('type')->orderBy('sort_order')->get(),
            'editing' => $request->filled('edit') ? Experience::find($request->integer('edit')) : null,
        ]);
    }

    public function store(Request $request)
    {
        Experience::create($this->validated($request));

        return redirect()->route('admin.experiences.index')->with('success', 'Pengalaman berhasil ditambahkan.');
    }

    public function update(Request $request, Experience $experience)
    {
        $experience->update($this->validated($request));

        return redirect()->route('admin.experiences.index')->with('success', 'Pengalaman berhasil diperbarui.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('success', 'Pengalaman berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'type' => 'required|in:plk,organisasi,lomba',
            'title' => 'required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'period' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);
    }
}
