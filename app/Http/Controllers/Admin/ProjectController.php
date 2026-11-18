<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Support\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.projects.index', [
            'projects' => Project::orderBy('sort_order')->orderByDesc('id')->get(),
            'editing' => $request->filled('edit') ? Project::find($request->integer('edit')) : null,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['image'] = Media::store($request->file('image_file'));
        $data['is_featured'] = $request->boolean('is_featured');

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function update(Request $request, Project $project)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['title'], $project->id);
        $data['is_featured'] = $request->boolean('is_featured');

        if ($upload = Media::store($request->file('image_file'))) {
            $data['image'] = $upload;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'required|string',
            'problem' => 'nullable|string',
            'goal' => 'nullable|string',
            'role' => 'nullable|string|max:255',
            'features' => 'nullable|string',
            'image_url' => 'nullable|string|max:2000',
            'image_file' => 'nullable|image|max:4096',
            'live_link' => 'nullable|url|max:500',
            'github_link' => 'nullable|url|max:500',
            'tech_stack' => 'nullable|string|max:255',
            'documentation' => 'nullable|string',
            'feedback' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'proyek';
        $slug = $base;
        $i = 2;

        while (Project::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
