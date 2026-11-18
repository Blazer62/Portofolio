@extends('layouts.app')

@section('title', $project->title.' | '.($siteProfile->name ?? 'Portofolio'))
@section('description', $project->description)

@section('content')
@php
    $image = \App\Support\Media::url($project->image) ?? \App\Support\Media::url($project->image_url);
    $paragraphs = preg_split('/\n{2,}/', (string) $project->documentation);
@endphp

<section class="pt-28 md:pt-32 pb-16 px-6 relative">
    <div class="max-w-5xl mx-auto">
        <a href="{{ route('home') }}#projects" class="inline-flex items-center gap-2 text-sm font-semibold dark:text-zinc-400 text-zinc-500 hover:text-emerald-500 transition-colors mb-8">
            <i class="fas fa-arrow-left text-xs"></i> Kembali ke daftar proyek
        </a>

        <div class="grid md:grid-cols-2 gap-10 items-center mb-14">
            <div class="animate-on-scroll">
                @if($project->category)
                <span class="inline-block px-3 py-1.5 rounded-full text-[10px] uppercase tracking-widest font-bold bg-emerald-500/10 text-emerald-500 mb-4">{{ $project->category }}</span>
                @endif
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">{{ $project->title }}</h1>
                <p class="text-base md:text-lg leading-relaxed dark:text-zinc-400 text-zinc-600 mb-6">{{ $project->description }}</p>

                <div class="flex flex-wrap gap-3">
                    @if($project->live_link)
                    <a href="{{ $project->live_link }}" target="_blank" rel="noopener" class="px-5 py-3 rounded-full text-sm font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 transition-colors">
                        <i class="fas fa-arrow-up-right-from-square mr-1.5 text-xs"></i> Lihat Demo
                    </a>
                    @endif
                    @if($project->github_link)
                    <a href="{{ $project->github_link }}" target="_blank" rel="noopener" class="px-5 py-3 rounded-full text-sm font-bold border dark:border-zinc-700 border-zinc-300 dark:text-zinc-200 text-zinc-700 hover:border-emerald-500 hover:text-emerald-500 transition-colors">
                        <i class="fab fa-github mr-1.5"></i> Source Code
                    </a>
                    @endif
                </div>
            </div>

            <div class="animate-on-scroll" style="transition-delay:120ms">
                @if($image)
                <img src="{{ $image }}" alt="Screenshot {{ $project->title }}" class="w-full rounded-[2rem] border dark:border-zinc-800 border-zinc-200 shadow-xl">
                @else
                <div class="w-full aspect-video rounded-[2rem] dark:bg-zinc-900 bg-zinc-100 flex items-center justify-center text-zinc-400">Tanpa Gambar</div>
                @endif
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8 items-start">
            <div class="lg:col-span-2 space-y-8">
                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="rounded-[1.5rem] border dark:border-zinc-800 border-zinc-200 dark:bg-zinc-900 bg-white p-6">
                        <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-3">Permasalahan</h2>
                        <p class="text-sm leading-relaxed dark:text-zinc-300 text-zinc-700">{{ $project->problem ?: 'Belum diisi.' }}</p>
                    </div>
                    <div class="rounded-[1.5rem] border dark:border-zinc-800 border-zinc-200 dark:bg-zinc-900 bg-white p-6">
                        <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-3">Tujuan</h2>
                        <p class="text-sm leading-relaxed dark:text-zinc-300 text-zinc-700">{{ $project->goal ?: 'Belum diisi.' }}</p>
                    </div>
                </div>

                <div class="rounded-[1.5rem] border dark:border-zinc-800 border-zinc-200 dark:bg-zinc-900 bg-white p-6 md:p-8">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-4">Fitur Utama</h2>
                    @if($project->featureList())
                    <ul class="grid sm:grid-cols-2 gap-3">
                        @foreach($project->featureList() as $feature)
                        <li class="flex items-start gap-2 text-sm dark:text-zinc-300 text-zinc-700">
                            <span class="text-emerald-500 mt-0.5"><i class="fas fa-check text-xs"></i></span>
                            <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-sm dark:text-zinc-500 text-zinc-500">Belum diisi.</p>
                    @endif
                </div>

                <div class="rounded-[1.5rem] border dark:border-zinc-800 border-zinc-200 dark:bg-zinc-900 bg-white p-6 md:p-8">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-4">Dokumentasi Proses</h2>
                    @if(trim((string) $project->documentation) !== '')
                        <div class="space-y-4 text-sm leading-relaxed dark:text-zinc-300 text-zinc-700">
                            @foreach($paragraphs as $paragraph)
                            <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                            @endforeach
                        </div>
                    @else
                    <p class="text-sm dark:text-zinc-500 text-zinc-500">Belum diisi.</p>
                    @endif
                </div>

                @if($project->feedback)
                <div class="rounded-[1.5rem] border border-emerald-500/25 bg-emerald-500/5 p-6 md:p-8">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-3">Feedback Pengguna</h2>
                    <p class="text-sm leading-relaxed dark:text-zinc-300 text-zinc-700">{{ $project->feedback }}</p>
                </div>
                @endif
            </div>

            <aside class="space-y-5">
                <div class="rounded-[1.5rem] border dark:border-zinc-800 border-zinc-200 dark:bg-zinc-900 bg-white p-6">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-3">Peran Saya</h2>
                    <p class="text-sm font-semibold dark:text-zinc-200 text-zinc-800">{{ $project->role ?: '-' }}</p>
                </div>

                <div class="rounded-[1.5rem] border dark:border-zinc-800 border-zinc-200 dark:bg-zinc-900 bg-white p-6">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-3">Teknologi</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->techList() as $tech)
                        <span class="text-[10px] uppercase tracking-wider font-bold px-2.5 py-1 rounded-md dark:bg-zinc-800 dark:text-zinc-300 bg-zinc-100 text-zinc-600">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>

                @if($related->isNotEmpty())
                <div class="rounded-[1.5rem] border dark:border-zinc-800 border-zinc-200 dark:bg-zinc-900 bg-white p-6">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-3">Proyek Lain</h2>
                    <div class="space-y-3">
                        @foreach($related as $item)
                        <a href="{{ route('projects.show', $item) }}" class="block group">
                            <p class="text-sm font-bold group-hover:text-emerald-500 transition-colors">{{ $item->title }}</p>
                            <p class="text-[11px] dark:text-zinc-500 text-zinc-500">{{ $item->category ?: 'Proyek' }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
</section>
@endsection
