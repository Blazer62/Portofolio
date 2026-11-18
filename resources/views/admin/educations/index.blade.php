@extends('layouts.admin')

@section('title', 'Kelola Pendidikan')
@section('header', 'Riwayat Pendidikan')
@section('subheader', 'Perbarui riwayat sekolah yang tampil di halaman About dan CV.')

@php
    $input = 'w-full px-3.5 py-2.5 rounded-xl border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20';
    $label = 'block text-xs font-bold uppercase tracking-wide text-zinc-500 dark:text-zinc-400 mb-1.5';
@endphp

@section('content')
<div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
        <h2 class="font-extrabold text-sm">Daftar Pendidikan</h2>
        <span class="text-xs text-zinc-500 dark:text-zinc-400 font-semibold">{{ $educations->count() }} data</span>
    </div>

    <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
        @forelse($educations as $education)
        <div class="px-5 py-4 flex items-center gap-3">
            <span class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xs font-extrabold">{{ $education->level }}</span>
            <div class="min-w-0 flex-1">
                <p class="font-bold">{{ $education->institution }}</p>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $education->major ?: 'Umum' }} • {{ $education->start_year }} – {{ $education->end_year }}</p>
            </div>
            <a href="{{ route('admin.educations.index', ['edit' => $education->id]) }}#educationForm" class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-emerald-600 hover:border-emerald-400 transition-colors"><i class="fas fa-pen text-xs"></i></a>
            <form method="POST" action="{{ route('admin.educations.destroy', $education) }}" onsubmit="return confirm('Hapus data pendidikan ini?')">
                @csrf @method('DELETE')
                <button class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-red-600 hover:border-red-400 transition-colors"><i class="fas fa-trash text-xs"></i></button>
            </form>
        </div>
        @empty
        <div class="px-5 py-10 text-center text-sm text-zinc-400 dark:text-zinc-500">Belum ada data pendidikan.</div>
        @endforelse
    </div>
</div>

<div id="educationForm" class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 md:p-6">
    <div class="flex items-center justify-between mb-5">
        <h2 class="font-extrabold">{{ $editing ? 'Edit Pendidikan' : 'Tambah Pendidikan' }}</h2>
        @if($editing)<a href="{{ route('admin.educations.index') }}" class="text-xs font-bold text-zinc-500 dark:text-zinc-400 hover:text-emerald-600"><i class="fas fa-xmark mr-1"></i> Batal edit</a>@endif
    </div>

    <form method="POST" action="{{ $editing ? route('admin.educations.update', $editing) : route('admin.educations.store') }}" class="grid md:grid-cols-2 gap-4">
        @csrf
        @if($editing) @method('PUT') @endif

        <div>
            <label class="{{ $label }}">Jenjang</label>
            <input type="text" name="level" value="{{ old('level', $editing->level ?? '') }}" required class="{{ $input }}" placeholder="SMK / SMP / SD">
        </div>
        <div>
            <label class="{{ $label }}">Nama Sekolah</label>
            <input type="text" name="institution" value="{{ old('institution', $editing->institution ?? '') }}" required class="{{ $input }}" placeholder="SMKN 2 Banjarmasin">
        </div>
        <div>
            <label class="{{ $label }}">Jurusan</label>
            <input type="text" name="major" value="{{ old('major', $editing->major ?? '') }}" class="{{ $input }}" placeholder="Rekayasa Perangkat Lunak">
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="{{ $label }}">Tahun Mulai</label>
                <input type="text" name="start_year" value="{{ old('start_year', $editing->start_year ?? '') }}" class="{{ $input }}" placeholder="2024">
            </div>
            <div>
                <label class="{{ $label }}">Tahun Selesai</label>
                <input type="text" name="end_year" value="{{ old('end_year', $editing->end_year ?? '') }}" class="{{ $input }}" placeholder="2027">
            </div>
        </div>
        <div class="md:col-span-2">
            <label class="{{ $label }}">Deskripsi</label>
            <textarea name="description" rows="2" class="{{ $input }}" placeholder="Keterangan singkat">{{ old('description', $editing->description ?? '') }}</textarea>
        </div>
        <div>
            <label class="{{ $label }}">Urutan</label>
            <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $editing->sort_order ?? 0) }}" class="{{ $input }}">
        </div>

        <div class="md:col-span-2 flex flex-wrap gap-2 pt-2 border-t border-zinc-100 dark:border-zinc-800">
            <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 transition-colors"><i class="fas fa-floppy-disk mr-1"></i> {{ $editing ? 'Simpan Perubahan' : 'Simpan Pendidikan' }}</button>
            @if($editing)<a href="{{ route('admin.educations.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold border border-zinc-300 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Batal</a>@endif
        </div>
    </form>
</div>
@endsection
