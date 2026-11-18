@extends('layouts.admin')

@section('title', 'Kelola Testimoni')
@section('header', 'Testimoni')
@section('subheader', 'Testimoni guru pembimbing, teman, pengguna, dan tempat PLK.')

@php
    $input = 'w-full px-3.5 py-2.5 rounded-xl border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20';
    $label = 'block text-xs font-bold uppercase tracking-wide text-zinc-500 dark:text-zinc-400 mb-1.5';
    $types = \App\Models\Testimonial::TYPES;
@endphp

@section('content')
<div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
        <h2 class="font-extrabold text-sm">Daftar Testimoni</h2>
        <span class="text-xs text-zinc-500 dark:text-zinc-400 font-semibold">{{ $testimonials->count() }} testimoni</span>
    </div>

    <div class="grid sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-zinc-100 dark:divide-zinc-800">
        @forelse($testimonials as $testimonial)
        <div class="p-5 flex items-start gap-3">
            <span class="w-10 h-10 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-extrabold shrink-0">{{ strtoupper(substr($testimonial->name, 0, 1)) }}</span>
            <div class="min-w-0 flex-1">
                <div class="flex flex-wrap items-center gap-2">
                    <p class="font-bold text-sm">{{ $testimonial->name }}</p>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">{{ $types[$testimonial->type] ?? $testimonial->type }}</span>
                </div>
                <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-1 line-clamp-2">{{ $testimonial->message }}</p>
            </div>
            <a href="{{ route('admin.testimonials.index', ['edit' => $testimonial->id]) }}#testimonialForm" class="text-zinc-400 dark:text-zinc-500 hover:text-emerald-600"><i class="fas fa-pen text-xs"></i></a>
            <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" onsubmit="return confirm('Hapus testimoni ini?')">
                @csrf @method('DELETE')
                <button class="text-zinc-400 dark:text-zinc-500 hover:text-red-600"><i class="fas fa-trash text-xs"></i></button>
            </form>
        </div>
        @empty
        <div class="p-5 text-sm text-zinc-400 dark:text-zinc-500 sm:col-span-2 text-center py-10">Belum ada testimoni.</div>
        @endforelse
    </div>
</div>

<div id="testimonialForm" class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 md:p-6">
    <div class="flex items-center justify-between mb-5">
        <h2 class="font-extrabold">{{ $editing ? 'Edit Testimoni' : 'Tambah Testimoni' }}</h2>
        @if($editing)<a href="{{ route('admin.testimonials.index') }}" class="text-xs font-bold text-zinc-500 dark:text-zinc-400 hover:text-emerald-600"><i class="fas fa-xmark mr-1"></i> Batal edit</a>@endif
    </div>

    <form method="POST" action="{{ $editing ? route('admin.testimonials.update', $editing) : route('admin.testimonials.store') }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4">
        @csrf
        @if($editing) @method('PUT') @endif

        <div>
            <label class="{{ $label }}">Nama</label>
            <input type="text" name="name" value="{{ old('name', $editing->name ?? '') }}" required class="{{ $input }}" placeholder="Nama pemberi testimoni">
        </div>
        <div>
            <label class="{{ $label }}">Kategori</label>
            <select name="type" class="{{ $input }}">
                @foreach($types as $value => $text)
                <option value="{{ $value }}" {{ old('type', $editing->type ?? 'teman') === $value ? 'selected' : '' }}>{{ $text }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="{{ $label }}">Foto (opsional)</label>
            <input type="file" name="photo_file" accept="image/*" class="w-full text-sm file:mr-3 file:px-3 file:py-2 file:rounded-lg file:border-0 file:bg-emerald-500 file:text-zinc-950 file:text-xs file:font-bold">
        </div>
        <div class="md:col-span-2">
            <label class="{{ $label }}">Isi Testimoni</label>
            <textarea name="message" rows="3" required class="{{ $input }}" placeholder="Tulis testimoni...">{{ old('message', $editing->message ?? '') }}</textarea>
        </div>
        <div>
            <label class="{{ $label }}">Urutan</label>
            <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $editing->sort_order ?? 0) }}" class="{{ $input }}">
        </div>

        <div class="md:col-span-2 flex flex-wrap gap-2 pt-2 border-t border-zinc-100 dark:border-zinc-800">
            <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 transition-colors"><i class="fas fa-floppy-disk mr-1"></i> {{ $editing ? 'Simpan Perubahan' : 'Simpan Testimoni' }}</button>
            @if($editing)<a href="{{ route('admin.testimonials.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold border border-zinc-300 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Batal</a>@endif
        </div>
    </form>
</div>
@endsection
