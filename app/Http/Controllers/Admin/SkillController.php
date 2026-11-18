<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.skills.index', [
            'skills' => Skill::orderBy('type')->orderBy('sort_order')->get(),
            'editing' => $request->filled('edit') ? Skill::find($request->integer('edit')) : null,
        ]);
    }

    public function store(Request $request)
    {
        Skill::create($this->validated($request));

        return redirect()->route('admin.skills.index')->with('success', 'Keahlian berhasil ditambahkan.');
    }

    public function update(Request $request, Skill $skill)
    {
        $skill->update($this->validated($request));

        return redirect()->route('admin.skills.index')->with('success', 'Keahlian berhasil diperbarui.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Keahlian berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:100',
            'percentage' => 'required|integer|min:0|max:100',
            'type' => 'required|in:hard,soft',
            'sort_order' => 'nullable|integer|min:0',
        ]);
    }
}
