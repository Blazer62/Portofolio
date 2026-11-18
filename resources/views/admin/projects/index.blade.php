@extends('layouts.admin')

@section('title', 'Kelola Proyek')
@section('header', 'Proyek')
@section('subheader', 'Tambah, edit, dan hapus proyek beserta detailnya.')
@section('actions')
<a href="#projectForm" class="px-4 py-2 rounded-xl text-xs font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 transition-colors">
    <i class="fas fa-plus mr-1"></i> Tambah Proyek
</a>
@endsection

@php
    $input = 'w-full px-3.5 py-2.5 rounded-xl border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20';
    $label = 'block text-xs font-bold uppercase tracking-wide text-zinc-500 dark:text-zinc-400 mb-1.5';
@endphp

@section('content')
<div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
        <h2 class="font-extrabold text-sm">Daftar Proyek</h2>
        <span class="text-xs text-zinc-500 dark:text-zinc-400 font-semibold">{{ $projects->count() }} proyek</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-zinc-50 dark:bg-zinc-950 text-left text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                <tr>
                    <th class="px-5 py-3 font-bold">Proyek</th>
                    <th class="px-3 py-3 font-bold">Teknologi</th>
                    <th class="px-3 py-3 font-bold text-center">Urutan</th>
                    <th class="px-3 py-3 font-bold">Link</th>
                    <th class="px-5 py-3 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                @forelse($projects as $project)
                @php $img = \App\Support\Media::url($project->image) ?? \App\Support\Media::url($project->image_url); @endphp
                <tr class="hover:bg-zinc-50/70 dark:hover:bg-zinc-800/70">
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            @if($img)
                            <img src="{{ $img }}" alt="" class="w-12 h-12 rounded-xl object-cover border border-zinc-200 dark:border-zinc-800">
                            @else
                            <span class="w-12 h-12 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-400 dark:text-zinc-500"><i class="fas fa-image"></i></span>
                            @endif
                            <div class="min-w-0">
                                <p class="font-bold truncate max-w-[220px]">{{ $project->title }}</p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $project->category ?: 'Tanpa kategori' }}{{ $project->is_featured ? ' • Unggulan' : '' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-3 py-3">
                        <div class="flex flex-wrap gap-1 max-w-[180px]">
                            @foreach(array_slice($project->techList(), 0, 3) as $tech)
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-3 py-3 text-center text-xs font-bold text-zinc-500 dark:text-zinc-400">{{ $project->sort_order }}</td>
                    <td class="px-3 py-3">
                        <div class="flex gap-1.5 text-xs">
                            @if($project->live_link)<a href="{{ $project->live_link }}" target="_blank" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-700" title="Demo"><i class="fas fa-arrow-up-right-from-square"></i></a>@endif
                            @if($project->github_link)<a href="{{ $project->github_link }}" target="_blank" class="text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white" title="GitHub"><i class="fab fa-github"></i></a>@endif
                        </div>
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex items-center justify-end gap-1.5">
                            <a href="{{ route('projects.show', $project) }}" target="_blank" class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-emerald-600 hover:border-emerald-400 transition-colors" title="Lihat"><i class="fas fa-eye text-xs"></i></a>
                            <a href="{{ route('admin.projects.index', ['edit' => $project->id]) }}#projectForm" class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-emerald-600 hover:border-emerald-400 transition-colors" title="Edit"><i class="fas fa-pen text-xs"></i></a>
                            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Hapus proyek {{ addslashes($project->title) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-red-600 hover:border-red-400 transition-colors" title="Hapus"><i class="fas fa-trash text-xs"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-5 py-10 text-center text-sm text-zinc-400 dark:text-zinc-500">Belum ada proyek. Tambahkan lewat form di bawah.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="projectForm" class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 md:p-6">
    <div class="flex items-center justify-between mb-5">
        <h2 class="font-extrabold">{{ $editing ? 'Edit Proyek' : 'Tambah Proyek Baru' }}</h2>
        @if($editing)
        <a href="{{ route('admin.projects.index') }}" class="text-xs font-bold text-zinc-500 dark:text-zinc-400 hover:text-emerald-600"><i class="fas fa-xmark mr-1"></i> Batal edit</a>
        @endif
    </div>

    <form method="POST" action="{{ $editing ? route('admin.projects.update', $editing) : route('admin.projects.store') }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4">
        @csrf
        @if($editing) @method('PUT') @endif

        <div>
            <label class="{{ $label }}">Judul Proyek</label>
            <input type="text" name="title" value="{{ old('title', $editing->title ?? '') }}" required class="{{ $input }}" placeholder="Contoh: Kalkulator Web">
        </div>
        <div>
            <label class="{{ $label }}">Kategori</label>
            <input type="text" name="category" value="{{ old('category', $editing->category ?? '') }}" class="{{ $input }}" placeholder="Web App / Website Referensi">
        </div>

        <div class="md:col-span-2">
            <label class="{{ $label }}">Deskripsi Singkat</label>
            <textarea name="description" rows="2" required class="{{ $input }}" placeholder="Ringkasan proyek">{{ old('description', $editing->description ?? '') }}</textarea>
        </div>

        <div>
            <label class="{{ $label }}">Permasalahan</label>
            <textarea name="problem" rows="4" class="{{ $input }}" placeholder="Masalah yang ingin diselesaikan">{{ old('problem', $editing->problem ?? '') }}</textarea>
        </div>
        <div>
            <label class="{{ $label }}">Tujuan</label>
            <textarea name="goal" rows="4" class="{{ $input }}" placeholder="Tujuan dibuatnya proyek">{{ old('goal', $editing->goal ?? '') }}</textarea>
        </div>

        <div>
            <label class="{{ $label }}">Peran dalam Proyek</label>
            <input type="text" name="role" value="{{ old('role', $editing->role ?? '') }}" class="{{ $input }}" placeholder="Frontend Developer (solo)">
        </div>
        <div>
            <label class="{{ $label }}">Teknologi (pisahkan koma)</label>
            <input type="text" name="tech_stack" value="{{ old('tech_stack', $editing->tech_stack ?? '') }}" class="{{ $input }}" placeholder="HTML, CSS, JavaScript">
        </div>

        <div class="md:col-span-2">
            <label class="{{ $label }}">Fitur (satu per baris)</label>
            <textarea name="features" rows="4" class="{{ $input }}" placeholder="Operasi aritmatika dasar&#10;Riwayat perhitungan&#10;Responsif">{{ old('features', $editing->features ?? '') }}</textarea>
        </div>

        <div>
            <label class="{{ $label }}">URL Demo</label>
            <input type="url" name="live_link" value="{{ old('live_link', $editing->live_link ?? '') }}" class="{{ $input }}" placeholder="https://proyek.vercel.app">
        </div>
        <div>
            <label class="{{ $label }}">URL Source Code (GitHub)</label>
            <input type="url" name="github_link" value="{{ old('github_link', $editing->github_link ?? '') }}" class="{{ $input }}" placeholder="https://github.com/username/repo">
        </div>

        <div>
            <label class="{{ $label }}">URL Gambar (opsional)</label>
            <input type="text" name="image_url" value="{{ old('image_url', $editing->image_url ?? '') }}" class="{{ $input }}" placeholder="/images/projects/proyek.png">
        </div>
        <div>
            <label class="{{ $label }}">Upload Gambar (opsional)</label>
            <input type="file" name="image_file" accept="image/*" class="w-full text-sm file:mr-3 file:px-3 file:py-2 file:rounded-lg file:border-0 file:bg-emerald-500 file:text-zinc-950 file:text-xs file:font-bold">
            @if($editing && $editing->image)
            <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1">Gambar saat ini: {{ $editing->image }}</p>
            @endif
        </div>

        <div class="md:col-span-2">
            <label class="{{ $label }}">Dokumentasi Proses Pekerjaan</label>
            <textarea name="documentation" rows="5" class="{{ $input }}" placeholder="Ceritakan proses pembuatan, kendala, dan solusinya. Pisahkan paragraf dengan baris kosong.">{{ old('documentation', $editing->documentation ?? '') }}</textarea>
        </div>

        <div class="md:col-span-2">
            <label class="{{ $label }}">Feedback Pengguna</label>
            <textarea name="feedback" rows="3" class="{{ $input }}" placeholder="Masukan dari pengguna atau guru">{{ old('feedback', $editing->feedback ?? '') }}</textarea>
        </div>

        <div>
            <label class="{{ $label }}">Urutan Tampil</label>
            <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $editing->sort_order ?? 0) }}" class="{{ $input }}">
        </div>
        <div class="flex items-end">
            <label class="inline-flex items-center gap-2 px-1 py-2.5 text-sm font-semibold">
                <input type="checkbox" name="is_featured" value="1" class="w-4 h-4 rounded border-zinc-300 dark:border-zinc-700 text-emerald-500 focus:ring-emerald-500" {{ old('is_featured', $editing->is_featured ?? false) ? 'checked' : '' }}>
                Tandai sebagai proyek unggulan
            </label>
        </div>

        <div class="md:col-span-2 flex flex-wrap gap-2 pt-2 border-t border-zinc-100 dark:border-zinc-800">
            <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 transition-colors">
                <i class="fas fa-floppy-disk mr-1"></i> {{ $editing ? 'Simpan Perubahan' : 'Simpan Proyek' }}
            </button>
            @if($editing)
            <a href="{{ route('admin.projects.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold border border-zinc-300 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Batal</a>
            @endif
        </div>
    </form>
</div>
@endsection
