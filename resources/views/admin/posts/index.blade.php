@extends('layouts.admin')

@section('title', 'Kelola Blog')
@section('header', 'Blog & Artikel')
@section('subheader', 'Tulis catatan ngoding, tutorial singkat, dan cerita proyek.')

@php
    $input = 'w-full px-3.5 py-2.5 rounded-xl border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20';
    $label = 'block text-xs font-bold uppercase tracking-wide text-zinc-500 dark:text-zinc-400 mb-1.5';
@endphp

@section('content')
<div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
        <h2 class="font-extrabold text-sm">Daftar Artikel</h2>
        <span class="text-xs text-zinc-500 dark:text-zinc-400 font-semibold">{{ $posts->count() }} artikel</span>
    </div>

    <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
        @forelse($posts as $post)
        <div class="px-5 py-4 flex items-center gap-3">
            @php $img = \App\Support\Media::url($post->image); @endphp
            @if($img)
            <img src="{{ $img }}" alt="" class="w-14 h-14 rounded-xl object-cover border border-zinc-200 dark:border-zinc-800">
            @else
            <span class="w-14 h-14 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 flex items-center justify-center"><i class="fas fa-pen-nib"></i></span>
            @endif
            <div class="min-w-0 flex-1">
                <p class="font-bold truncate">{{ $post->title }}</p>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                    {{ $post->tag ?: 'Tanpa tag' }} •
                    @if($post->published_at)
                    <span class="text-emerald-600 dark:text-emerald-400 font-semibold">Terbit {{ $post->published_at->format('d M Y') }}</span>
                    @else
                    <span class="text-amber-600 dark:text-amber-400 font-semibold">Draft</span>
                    @endif
                </p>
            </div>
            @if($post->published_at)
            <a href="{{ route('blog.show', $post) }}" target="_blank" class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-emerald-600 hover:border-emerald-400 transition-colors"><i class="fas fa-eye text-xs"></i></a>
            @endif
            <a href="{{ route('admin.posts.index', ['edit' => $post->id]) }}#postForm" class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-emerald-600 hover:border-emerald-400 transition-colors"><i class="fas fa-pen text-xs"></i></a>
            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Hapus artikel ini?')">
                @csrf @method('DELETE')
                <button class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-red-600 hover:border-red-400 transition-colors"><i class="fas fa-trash text-xs"></i></button>
            </form>
        </div>
        @empty
        <div class="px-5 py-10 text-center text-sm text-zinc-400 dark:text-zinc-500">Belum ada artikel.</div>
        @endforelse
    </div>
</div>

<div id="postForm" class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 md:p-6">
    <div class="flex items-center justify-between mb-5">
        <h2 class="font-extrabold">{{ $editing ? 'Edit Artikel' : 'Tulis Artikel Baru' }}</h2>
        @if($editing)<a href="{{ route('admin.posts.index') }}" class="text-xs font-bold text-zinc-500 dark:text-zinc-400 hover:text-emerald-600"><i class="fas fa-xmark mr-1"></i> Batal edit</a>@endif
    </div>

    <form method="POST" action="{{ $editing ? route('admin.posts.update', $editing) : route('admin.posts.store') }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4">
        @csrf
        @if($editing) @method('PUT') @endif

        <div class="md:col-span-2">
            <label class="{{ $label }}">Judul Artikel</label>
            <input type="text" name="title" value="{{ old('title', $editing->title ?? '') }}" required class="{{ $input }}" placeholder="5 Konsep JavaScript untuk Pemula">
        </div>
        <div>
            <label class="{{ $label }}">Tag / Kategori</label>
            <input type="text" name="tag" value="{{ old('tag', $editing->tag ?? '') }}" class="{{ $input }}" placeholder="JavaScript">
        </div>
        <div>
            <label class="{{ $label }}">Gambar Sampul</label>
            <input type="file" name="image_file" accept="image/*" class="w-full text-sm file:mr-3 file:px-3 file:py-2 file:rounded-lg file:border-0 file:bg-emerald-500 file:text-zinc-950 file:text-xs file:font-bold">
        </div>
        <div class="md:col-span-2">
            <label class="{{ $label }}">Ringkasan</label>
            <textarea name="excerpt" rows="2" class="{{ $input }}" placeholder="Ringkasan singkat artikel">{{ old('excerpt', $editing->excerpt ?? '') }}</textarea>
        </div>
        <div class="md:col-span-2">
            <label class="{{ $label }}">Isi Artikel</label>
            <textarea name="content" rows="10" required class="{{ $input }}" placeholder="Pisahkan paragraf dengan baris kosong.">{{ old('content', $editing->content ?? '') }}</textarea>
        </div>
        <div>
            <label class="{{ $label }}">Tanggal Terbit</label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at', $editing?->published_at ? $editing->published_at->format('Y-m-d\TH:i') : '') }}" class="{{ $input }}">
        </div>
        <div class="flex items-end">
            <label class="inline-flex items-center gap-2 px-1 py-2.5 text-sm font-semibold">
                <input type="checkbox" name="publish" value="1" class="w-4 h-4 rounded border-zinc-300 dark:border-zinc-700 text-emerald-500 focus:ring-emerald-500" {{ old('publish', (bool) ($editing->published_at ?? false)) ? 'checked' : '' }}>
                Publikasikan artikel
            </label>
        </div>

        <div class="md:col-span-2 flex flex-wrap gap-2 pt-2 border-t border-zinc-100 dark:border-zinc-800">
            <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 transition-colors"><i class="fas fa-floppy-disk mr-1"></i> {{ $editing ? 'Simpan Perubahan' : 'Simpan Artikel' }}</button>
            @if($editing)<a href="{{ route('admin.posts.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold border border-zinc-300 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Batal</a>@endif
        </div>
    </form>
</div>
@endsection
