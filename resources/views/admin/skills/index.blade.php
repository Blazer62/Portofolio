@extends('layouts.admin')

@section('title', 'Kelola Keahlian')
@section('header', 'Keahlian')
@section('subheader', 'Atur hard skill dan soft skill beserta persentasenya.')

@php
    $input = 'w-full px-3.5 py-2.5 rounded-xl border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20';
    $label = 'block text-xs font-bold uppercase tracking-wide text-zinc-500 dark:text-zinc-400 mb-1.5';
@endphp

@section('content')
<div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
        <h2 class="font-extrabold text-sm">Daftar Keahlian</h2>
        <span class="text-xs text-zinc-500 dark:text-zinc-400 font-semibold">{{ $skills->count() }} keahlian</span>
    </div>

    <div class="p-5 grid gap-4 sm:grid-cols-2">
        @foreach(['hard' => 'Hard Skill', 'soft' => 'Soft Skill'] as $type => $typeLabel)
        <div>
            <h3 class="text-xs font-bold uppercase tracking-widest text-emerald-600 dark:text-emerald-400 mb-3">{{ $typeLabel }}</h3>
            <div class="space-y-2">
                @forelse($skills->where('type', $type) as $skill)
                <div class="flex items-center gap-3 rounded-xl border border-zinc-200 dark:border-zinc-800 px-3 py-2">
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between text-xs font-semibold mb-1">
                            <span class="truncate">{{ $skill->name }}</span>
                            <span class="text-zinc-500 dark:text-zinc-400">{{ $skill->percentage }}%</span>
                        </div>
                        <div class="h-1.5 rounded-full bg-zinc-100 dark:bg-zinc-800 overflow-hidden">
                            <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $skill->percentage }}%"></div>
                        </div>
                    </div>
                    <a href="{{ route('admin.skills.index', ['edit' => $skill->id]) }}#skillForm" class="text-zinc-400 dark:text-zinc-500 hover:text-emerald-600"><i class="fas fa-pen text-xs"></i></a>
                    <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" onsubmit="return confirm('Hapus keahlian ini?')">
                        @csrf @method('DELETE')
                        <button class="text-zinc-400 dark:text-zinc-500 hover:text-red-600"><i class="fas fa-trash text-xs"></i></button>
                    </form>
                </div>
                @empty
                <p class="text-xs text-zinc-400 dark:text-zinc-500">Belum ada data.</p>
                @endforelse
            </div>
        </div>
        @endforeach
    </div>
</div>

<div id="skillForm" class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 md:p-6">
    <div class="flex items-center justify-between mb-5">
        <h2 class="font-extrabold">{{ $editing ? 'Edit Keahlian' : 'Tambah Keahlian' }}</h2>
        @if($editing)<a href="{{ route('admin.skills.index') }}" class="text-xs font-bold text-zinc-500 dark:text-zinc-400 hover:text-emerald-600"><i class="fas fa-xmark mr-1"></i> Batal edit</a>@endif
    </div>

    <form method="POST" action="{{ $editing ? route('admin.skills.update', $editing) : route('admin.skills.store') }}" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @csrf
        @if($editing) @method('PUT') @endif

        <div class="lg:col-span-2">
            <label class="{{ $label }}">Nama Keahlian</label>
            <input type="text" name="name" value="{{ old('name', $editing->name ?? '') }}" required class="{{ $input }}" placeholder="JavaScript">
        </div>
        <div>
            <label class="{{ $label }}">Persentase</label>
            <input type="number" name="percentage" min="0" max="100" value="{{ old('percentage', $editing->percentage ?? 80) }}" required class="{{ $input }}">
        </div>
        <div>
            <label class="{{ $label }}">Jenis</label>
            <select name="type" class="{{ $input }}">
                <option value="hard" {{ old('type', $editing->type ?? 'hard') === 'hard' ? 'selected' : '' }}>Hard Skill</option>
                <option value="soft" {{ old('type', $editing->type ?? '') === 'soft' ? 'selected' : '' }}>Soft Skill</option>
            </select>
        </div>
        <div>
            <label class="{{ $label }}">Urutan</label>
            <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $editing->sort_order ?? 0) }}" class="{{ $input }}">
        </div>

        <div class="sm:col-span-2 lg:col-span-4 flex flex-wrap gap-2 pt-2 border-t border-zinc-100 dark:border-zinc-800">
            <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 transition-colors"><i class="fas fa-floppy-disk mr-1"></i> {{ $editing ? 'Simpan Perubahan' : 'Simpan Keahlian' }}</button>
            @if($editing)<a href="{{ route('admin.skills.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold border border-zinc-300 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Batal</a>@endif
        </div>
    </form>
</div>
@endsection
