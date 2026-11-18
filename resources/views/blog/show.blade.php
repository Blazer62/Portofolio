@extends('layouts.app')

@section('title', $post->title.' | Blog')
@section('description', $post->excerpt)

@section('content')
<section class="pt-28 md:pt-32 pb-16 px-6">
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold dark:text-zinc-400 text-zinc-500 hover:text-emerald-500 transition-colors mb-8">
            <i class="fas fa-arrow-left text-xs"></i> Kembali ke blog
        </a>

        <article>
            <div class="mb-6">
                @if($post->tag)
                <span class="inline-block px-3 py-1.5 rounded-full text-[10px] uppercase tracking-widest font-bold bg-emerald-500/10 text-emerald-500 mb-4">{{ $post->tag }}</span>
                @endif
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight mb-4">{{ $post->title }}</h1>
                <p class="text-sm dark:text-zinc-500 text-zinc-500">
                    <i class="far fa-calendar mr-1"></i> {{ $post->published_at?->locale('id')->translatedFormat('d F Y') }}
                    <span class="mx-2">•</span>
                    <i class="far fa-user mr-1"></i> {{ $siteProfile->name ?? 'Admin' }}
                </p>
            </div>

            @php $image = \App\Support\Media::url($post->image); @endphp
            @if($image)
            <img src="{{ $image }}" alt="{{ $post->title }}" class="w-full rounded-[2rem] border dark:border-zinc-800 border-zinc-200 mb-8">
            @endif

            @if($post->excerpt)
            <p class="text-lg leading-relaxed dark:text-zinc-300 text-zinc-700 font-medium mb-6">{{ $post->excerpt }}</p>
            @endif

            <div class="space-y-5 text-base leading-relaxed dark:text-zinc-300 text-zinc-700">
                @foreach(preg_split('/\n{2,}/', (string) $post->content) as $paragraph)
                <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                @endforeach
            </div>
        </article>

        <div class="mt-12 pt-8 border-t dark:border-zinc-800 border-zinc-200">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-500 hover:text-emerald-600 transition-colors">
                <i class="fas fa-arrow-left text-xs"></i> Artikel lainnya
            </a>
        </div>

        @if($related->isNotEmpty())
        <div class="mt-12">
            <h2 class="text-sm font-bold uppercase tracking-widest text-emerald-500 mb-4">Baca Juga</h2>
            <div class="grid sm:grid-cols-3 gap-4">
                @foreach($related as $item)
                <a href="{{ route('blog.show', $item) }}" class="rounded-2xl border dark:border-zinc-800 border-zinc-200 dark:bg-zinc-900 bg-white p-4 hover:border-emerald-500 transition-colors">
                    <p class="text-xs dark:text-zinc-500 text-zinc-500 mb-1">{{ $item->tag ?: 'Artikel' }}</p>
                    <p class="text-sm font-bold leading-snug">{{ $item->title }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
