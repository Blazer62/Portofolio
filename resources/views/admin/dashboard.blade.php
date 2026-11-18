@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard')
@section('subheader', 'Ringkasan konten dan aktivitas terbaru.')

@section('content')
<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    @foreach([
        ['Proyek', $stats['projects'], 'fa-folder-open', 'admin.projects.index'],
        ['Sertifikat', $stats['certificates'], 'fa-award', 'admin.certificates.index'],
        ['Artikel Blog', $stats['posts'], 'fa-pen-nib', 'admin.posts.index'],
        ['Pesan Belum Dibaca', $stats['unread'], 'fa-envelope', 'admin.messages.index'],
    ] as [$label, $value, $icon, $route])
    <a href="{{ route($route) }}" class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 hover:border-emerald-400 hover:shadow-lg hover:shadow-emerald-500/5 transition-all">
        <div class="flex items-center justify-between mb-3">
            <span class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                <i class="fas {{ $icon }}"></i>
            </span>
            <i class="fas fa-arrow-right text-xs text-zinc-300 dark:text-zinc-600"></i>
        </div>
        <p class="text-3xl font-extrabold leading-none">{{ $value }}</p>
        <p class="text-xs text-zinc-500 dark:text-zinc-400 font-semibold mt-1">{{ $label }}</p>
    </a>
    @endforeach
</div>

<div class="grid lg:grid-cols-2 gap-6">
    <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden">
        <div class="px-5 py-4 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
            <h2 class="font-extrabold text-sm">Pesan Terbaru</h2>
            <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700">Lihat semua</a>
        </div>

        <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
            @forelse($messages as $message)
            <div class="px-5 py-4 flex items-start gap-3">
                <span class="w-9 h-9 shrink-0 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-sm font-extrabold">
                    {{ strtoupper(substr($message->name, 0, 1)) }}
                </span>
                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-2 flex-wrap">
                        <p class="text-sm font-bold">{{ $message->name }}</p>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $message->type === 'guestbook' ? 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400' }}">
                            {{ $message->type === 'guestbook' ? 'Kesan & Pesan' : 'Kontak' }}
                        </span>
                        @if(! $message->is_read)
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400">Baru</span>
                        @endif
                    </div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 line-clamp-2 mt-1">{{ $message->message }}</p>
                </div>
                <span class="text-[10px] text-zinc-400 dark:text-zinc-500 whitespace-nowrap">{{ $message->created_at->diffForHumans() }}</span>
            </div>
            @empty
            <div class="px-5 py-10 text-center text-sm text-zinc-400 dark:text-zinc-500">Belum ada pesan masuk.</div>
            @endforelse
        </div>
    </div>

    <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden">
        <div class="px-5 py-4 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
            <h2 class="font-extrabold text-sm">Proyek Terbaru</h2>
            <a href="{{ route('admin.projects.index') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700">Kelola proyek</a>
        </div>

        <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
            @forelse($projects as $project)
            <div class="px-5 py-4 flex items-center gap-3">
                @php $img = \App\Support\Media::url($project->image) ?? \App\Support\Media::url($project->image_url); @endphp
                @if($img)
                <img src="{{ $img }}" alt="" class="w-12 h-12 rounded-xl object-cover border border-zinc-200 dark:border-zinc-800">
                @else
                <span class="w-12 h-12 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-400 dark:text-zinc-500"><i class="fas fa-image"></i></span>
                @endif
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-bold truncate">{{ $project->title }}</p>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $project->category ?: 'Tanpa kategori' }}</p>
                </div>
                <a href="{{ route('admin.projects.index', ['edit' => $project->id]) }}" class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-emerald-600 hover:border-emerald-400 transition-colors">
                    <i class="fas fa-pen text-xs"></i>
                </a>
            </div>
            @empty
            <div class="px-5 py-10 text-center text-sm text-zinc-400 dark:text-zinc-500">Belum ada proyek.</div>
            @endforelse
        </div>
    </div>
</div>

<div class="mt-6 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5">
    <h2 class="font-extrabold text-sm mb-3">Aksi Cepat</h2>
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 transition-colors"><i class="fas fa-plus mr-1"></i> Tambah Proyek</a>
        <a href="{{ route('admin.certificates.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold border border-zinc-200 dark:border-zinc-800 hover:border-emerald-400 hover:text-emerald-600 transition-colors"><i class="fas fa-plus mr-1"></i> Tambah Sertifikat</a>
        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold border border-zinc-200 dark:border-zinc-800 hover:border-emerald-400 hover:text-emerald-600 transition-colors"><i class="fas fa-plus mr-1"></i> Tulis Artikel</a>
        <a href="{{ route('admin.profile.edit') }}" class="px-4 py-2 rounded-xl text-xs font-bold border border-zinc-200 dark:border-zinc-800 hover:border-emerald-400 hover:text-emerald-600 transition-colors"><i class="fas fa-user-pen mr-1"></i> Edit Profil</a>
    </div>
</div>
@endsection
