@extends('layouts.admin')

@section('title', 'Kelola Sertifikat')
@section('header', 'Sertifikat')
@section('subheader', 'Tambah dan hapus sertifikat beserta dokumentasinya.')

@php
    $input = 'w-full px-3.5 py-2.5 rounded-xl border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20';
    $label = 'block text-xs font-bold uppercase tracking-wide text-zinc-500 dark:text-zinc-400 mb-1.5';
@endphp

@section('content')
<div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
        <h2 class="font-extrabold text-sm">Daftar Sertifikat</h2>
        <span class="text-xs text-zinc-500 dark:text-zinc-400 font-semibold">{{ $certificates->count() }} dokumen</span>
    </div>

    <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
        @forelse($certificates as $certificate)
        @php $img = \App\Support\Media::url($certificate->image); @endphp
        <div class="px-5 py-4 flex items-center gap-4">
            @if($img)
            <img src="{{ $img }}" alt="" class="w-14 h-14 rounded-xl object-cover border border-zinc-200 dark:border-zinc-800">
            @else
            <span class="w-14 h-14 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 flex items-center justify-center"><i class="fas fa-award"></i></span>
            @endif
            <div class="min-w-0 flex-1">
                <p class="font-bold truncate">{{ $certificate->title }}</p>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $certificate->issuer }}{{ $certificate->year ? ' • '.$certificate->year : '' }}</p>
                @if($certificate->file)
                <a href="{{ \App\Support\Media::url($certificate->file) }}" target="_blank" class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400"><i class="fas fa-file-lines mr-1"></i>Dokumentasi</a>
                @endif
            </div>
            <a href="{{ route('admin.certificates.index', ['edit' => $certificate->id]) }}#certificateForm" class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-emerald-600 hover:border-emerald-400 transition-colors"><i class="fas fa-pen text-xs"></i></a>
            <form method="POST" action="{{ route('admin.certificates.destroy', $certificate) }}" onsubmit="return confirm('Hapus sertifikat ini?')">
                @csrf @method('DELETE')
                <button class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-red-600 hover:border-red-400 transition-colors"><i class="fas fa-trash text-xs"></i></button>
            </form>
        </div>
        @empty
        <div class="px-5 py-10 text-center text-sm text-zinc-400 dark:text-zinc-500">Belum ada sertifikat.</div>
        @endforelse
    </div>
</div>

<div id="certificateForm" class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 md:p-6">
    <div class="flex items-center justify-between mb-5">
        <h2 class="font-extrabold">{{ $editing ? 'Edit Sertifikat' : 'Tambah Sertifikat' }}</h2>
        @if($editing)<a href="{{ route('admin.certificates.index') }}" class="text-xs font-bold text-zinc-500 dark:text-zinc-400 hover:text-emerald-600"><i class="fas fa-xmark mr-1"></i> Batal edit</a>@endif
    </div>

    <form method="POST" action="{{ $editing ? route('admin.certificates.update', $editing) : route('admin.certificates.store') }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4">
        @csrf
        @if($editing) @method('PUT') @endif

        <div class="md:col-span-2">
            <label class="{{ $label }}">Nama Sertifikat</label>
            <input type="text" name="title" value="{{ old('title', $editing->title ?? '') }}" required class="{{ $input }}" placeholder="Sertifikat Praktik Kerja Lapangan">
        </div>
        <div>
            <label class="{{ $label }}">Penerbit</label>
            <input type="text" name="issuer" value="{{ old('issuer', $editing->issuer ?? '') }}" class="{{ $input }}" placeholder="Nama lembaga / instansi">
        </div>
        <div>
            <label class="{{ $label }}">Tahun</label>
            <input type="text" name="year" value="{{ old('year', $editing->year ?? '') }}" class="{{ $input }}" placeholder="2026">
        </div>
        <div class="md:col-span-2">
            <label class="{{ $label }}">Deskripsi</label>
            <textarea name="description" rows="3" class="{{ $input }}" placeholder="Keterangan singkat">{{ old('description', $editing->description ?? '') }}</textarea>
        </div>
        <div>
            <label class="{{ $label }}">Gambar Sertifikat</label>
            <input type="file" name="image_file" accept="image/*" class="w-full text-sm file:mr-3 file:px-3 file:py-2 file:rounded-lg file:border-0 file:bg-emerald-500 file:text-zinc-950 file:text-xs file:font-bold">
        </div>
        <div>
            <label class="{{ $label }}">File Dokumentasi (PDF/Gambar)</label>
            <input type="file" name="certificate_file" accept=".pdf,image/*" class="w-full text-sm file:mr-3 file:px-3 file:py-2 file:rounded-lg file:border-0 file:bg-zinc-800 file:text-white file:text-xs file:font-bold">
        </div>
        <div>
            <label class="{{ $label }}">Urutan</label>
            <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $editing->sort_order ?? 0) }}" class="{{ $input }}">
        </div>

        <div class="md:col-span-2 flex flex-wrap gap-2 pt-2 border-t border-zinc-100 dark:border-zinc-800">
            <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 transition-colors"><i class="fas fa-floppy-disk mr-1"></i> {{ $editing ? 'Simpan Perubahan' : 'Simpan Sertifikat' }}</button>
            @if($editing)<a href="{{ route('admin.certificates.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold border border-zinc-300 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Batal</a>@endif
        </div>
    </form>
</div>
@endsection
