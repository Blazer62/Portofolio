@extends('layouts.admin')

@section('title', 'Kelola Pengalaman')
@section('header', 'Pengalaman')
@section('subheader', 'Kelola pengalaman PLK, organisasi, kepanitiaan, dan lomba.')

@php
    $input = 'w-full px-3.5 py-2.5 rounded-xl border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20';
    $label = 'block text-xs font-bold uppercase tracking-wide text-zinc-500 dark:text-zinc-400 mb-1.5';
    $types = \App\Models\Experience::TYPES;
@endphp

@section('content')
<div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
        <h2 class="font-extrabold text-sm">Daftar Pengalaman</h2>
        <span class="text-xs text-zinc-500 dark:text-zinc-400 font-semibold">{{ $experiences->count() }} data</span>
    </div>

    <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
        @forelse($experiences as $experience)
        <div class="px-5 py-4 flex items-start gap-3">
            <span class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0"><i class="fas fa-briefcase text-xs"></i></span>
            <div class="min-w-0 flex-1">
                <div class="flex flex-wrap items-center gap-2">
                    <p class="font-bold">{{ $experience->title }}</p>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">{{ $types[$experience->type] ?? $experience->type }}</span>
                </div>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $experience->organization }}{{ $experience->period ? ' • '.$experience->period : '' }}</p>
            </div>
            <a href="{{ route('admin.experiences.index', ['edit' => $experience->id]) }}#experienceForm" class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-emerald-600 hover:border-emerald-400 transition-colors"><i class="fas fa-pen text-xs"></i></a>
            <form method="POST" action="{{ route('admin.experiences.destroy', $experience) }}" onsubmit="return confirm('Hapus pengalaman ini?')">
                @csrf @method('DELETE')
                <button class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-red-600 hover:border-red-400 transition-colors"><i class="fas fa-trash text-xs"></i></button>
            </form>
        </div>
        @empty
        <div class="px-5 py-10 text-center text-sm text-zinc-400 dark:text-zinc-500">Belum ada pengalaman.</div>
        @endforelse
    </div>
</div>

<div id="experienceForm" class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 md:p-6">
    <div class="flex items-center justify-between mb-5">
        <h2 class="font-extrabold">{{ $editing ? 'Edit Pengalaman' : 'Tambah Pengalaman' }}</h2>
        @if($editing)<a href="{{ route('admin.experiences.index') }}" class="text-xs font-bold text-zinc-500 dark:text-zinc-400 hover:text-emerald-600"><i class="fas fa-xmark mr-1"></i> Batal edit</a>@endif
    </div>

    <form method="POST" action="{{ $editing ? route('admin.experiences.update', $editing) : route('admin.experiences.store') }}" class="grid md:grid-cols-2 gap-4">
        @csrf
        @if($editing) @method('PUT') @endif

        <div>
            <label class="{{ $label }}">Jenis</label>
            <select name="type" class="{{ $input }}">
                @foreach($types as $value => $text)
                <option value="{{ $value }}" {{ old('type', $editing->type ?? 'plk') === $value ? 'selected' : '' }}>{{ $text }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="{{ $label }}">Posisi / Judul</label>
            <input type="text" name="title" value="{{ old('title', $editing->title ?? '') }}" required class="{{ $input }}" placeholder="Praktik Kerja Lapangan – Frontend Developer">
        </div>
        <div>
            <label class="{{ $label }}">Instansi / Organisasi</label>
            <input type="text" name="organization" value="{{ old('organization', $editing->organization ?? '') }}" class="{{ $input }}" placeholder="Nama perusahaan / organisasi">
        </div>
        <div>
            <label class="{{ $label }}">Periode</label>
            <input type="text" name="period" value="{{ old('period', $editing->period ?? '') }}" class="{{ $input }}" placeholder="Juli – September 2026">
        </div>
        <div class="md:col-span-2">
            <label class="{{ $label }}">Deskripsi</label>
            <textarea name="description" rows="3" class="{{ $input }}" placeholder="Tugas dan pencapaian">{{ old('description', $editing->description ?? '') }}</textarea>
        </div>
        <div>
            <label class="{{ $label }}">Urutan</label>
            <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $editing->sort_order ?? 0) }}" class="{{ $input }}">
        </div>

        <div class="md:col-span-2 flex flex-wrap gap-2 pt-2 border-t border-zinc-100 dark:border-zinc-800">
            <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 transition-colors"><i class="fas fa-floppy-disk mr-1"></i> {{ $editing ? 'Simpan Perubahan' : 'Simpan Pengalaman' }}</button>
            @if($editing)<a href="{{ route('admin.experiences.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold border border-zinc-300 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Batal</a>@endif
        </div>
    </form>
</div>
@endsection
