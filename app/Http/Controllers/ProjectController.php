<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url'   => 'nullable|string|max:10000000',
            'live_link'   => 'nullable|string|max:500',
            'tech_stack'  => 'nullable|string|max:255',
        ]);

        Project::create($data);

        return redirect()->route('home')->with('success', 'Project berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url'   => 'nullable|string|max:10000000',
            'live_link'   => 'nullable|string|max:500',
            'tech_stack'  => 'nullable|string|max:255',
        ]);

        $project->update($data);

        return redirect()->route('home')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('home')->with('success', 'Project berhasil dihapus!');
    }
}
