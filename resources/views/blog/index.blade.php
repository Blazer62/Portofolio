@extends('layouts.app')

@section('title', 'Blog & Artikel | '.($siteProfile->name ?? 'Portofolio'))
@section('description', 'Catatan ngoding, tutorial singkat, dan cerita proses pembuatan proyek.')

@section('content')
<section class="pt-28 md:pt-32 pb-16 px-6">
    <div class="max-w-5xl mx-auto">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold dark:text-zinc-400 text-zinc-500 hover:text-emerald-500 transition-colors mb-8">
            <i class="fas fa-arrow-left text-xs"></i> Kembali ke beranda
        </a>

        <div class="mb-12">
            <span class="section-kicker mb-4">Blog Pengembang</span>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">Catatan Ngoding</h1>
            <p class="text-sm md:text-base dark:text-zinc-400 text-zinc-600 mt-3 max-w-2xl">Tulisan singkat tentang proses belajar, tips frontend, dan cerita di balik proyek yang saya kerjakan.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $post)
            @php $image = \App\Support\Media::url($post->image); @endphp
            <article class="group rounded-[1.75rem] overflow-hidden border dark:bg-zinc-900 dark:border-zinc-800 bg-white border-zinc-200 flex flex-col transition-all duration-500 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-emerald-500/10">
                <a href="{{ route('blog.show', $post) }}" class="block h-40 overflow-hidden dark:bg-zinc-950 bg-zinc-100 relative">
                    @if($image)
                    <img src="{{ $image }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-emerald-500/15 to-emerald-500/5">
                        <i class="fas fa-code text-4xl text-emerald-500/60"></i>
                    </div>
                    @endif
                    @if($post->tag)
                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-[10px] uppercase tracking-widest font-bold bg-zinc-950/80 text-white backdrop-blur">{{ $post->tag }}</span>
                    @endif
                </a>
                <div class="p-5 flex-1 flex flex-col">
                    <p class="text-[11px] font-semibold dark:text-zinc-500 text-zinc-500 mb-2">
                        <i class="far fa-calendar mr-1"></i> {{ $post->published_at?->locale('id')->translatedFormat('d F Y') }}
                    </p>
                    <h2 class="font-extrabold leading-snug mb-2 group-hover:text-emerald-500 transition-colors">
                        <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                    </h2>
                    <p class="text-sm leading-relaxed dark:text-zinc-400 text-zinc-600 flex-1">{{ $post->excerpt }}</p>
                    <a href="{{ route('blog.show', $post) }}" class="mt-4 inline-flex items-center gap-1.5 text-xs font-bold text-emerald-500 hover:text-emerald-600 transition-colors">
                        Baca artikel <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-20 rounded-[2rem] border-2 border-dashed dark:border-zinc-800 dark:text-zinc-600 border-zinc-300 text-zinc-400">
                <i class="fas fa-pen-nib text-4xl mb-3 opacity-60"></i>
                <p class="font-semibold">Belum ada artikel yang dipublikasikan.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $posts->links() }}
        </div>
    </div>
</section>
@endsection
