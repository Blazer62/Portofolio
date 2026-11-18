<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Support\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.posts.index', [
            'posts' => Post::orderByDesc('published_at')->orderByDesc('id')->get(),
            'editing' => $request->filled('edit') ? Post::find($request->integer('edit')) : null,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['image'] = Media::store($request->file('image_file'));

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['title'], $post->id);

        if ($upload = Media::store($request->file('image_file'))) {
            $data['image'] = $upload;
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image_file' => 'nullable|image|max:4096',
            'published_at' => 'nullable|date',
        ]);

        $data['published_at'] = $request->boolean('publish')
            ? ($data['published_at'] ?? now())
            : null;

        return $data;
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'artikel';
        $slug = $base;
        $i = 2;

        while (Post::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
