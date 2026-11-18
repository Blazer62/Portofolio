@php
    $photo = \App\Support\Media::url($siteProfile->photo ?? null);
@endphp

<section id="beranda" class="min-h-screen flex items-center justify-center pt-28 pb-12 md:pt-24 md:pb-0 px-6 relative overflow-hidden bg-pattern">
    <div class="absolute top-1/4 -left-32 w-96 h-96 bg-emerald-500/20 rounded-full blur-[100px]"></div>
    <div class="absolute bottom-1/4 -right-32 w-96 h-96 bg-emerald-500/10 rounded-full blur-[100px]"></div>

    <div class="max-w-6xl mx-auto w-full z-10 grid md:grid-cols-2 gap-12 items-center">
        <div class="animate-on-scroll relative flex flex-col order-2 md:order-1">
            <h1 class="text-4xl sm:text-5xl md:text-4xl lg:text-[2.6rem] xl:text-6xl font-extrabold tracking-tight mb-4 leading-[1.12]">
                <span class="glitch-text" data-text="{{ $siteProfile->name ?? 'Gusti Rizky' }}">{{ $siteProfile->name ?? 'Gusti Rizky' }}</span><br/>
                <span class="text-emerald-500">{{ $siteProfile->headline ?? 'Frontend Developer' }}</span>
            </h1>

            <div class="flex flex-wrap items-center gap-2 mb-5">
                @if($siteProfile->class)
                <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                    Kelas {{ $siteProfile->class }}
                </span>
                @endif
                @if($siteProfile->major)
                <span class="px-3 py-1.5 rounded-full text-xs font-bold dark:bg-zinc-900 bg-white border dark:border-zinc-800 border-zinc-200 dark:text-zinc-300 text-zinc-600">
                    {{ $siteProfile->major }}
                </span>
                @endif
            </div>

            <p class="text-base md:text-lg leading-relaxed mb-8 max-w-md dark:text-zinc-400 text-zinc-600">
                {{ $siteProfile->tagline ?? 'Membangun antarmuka web yang rapi, responsif, dan nyaman dipakai.' }}
            </p>

            <div class="flex flex-wrap gap-3">
                <a href="#projects" class="px-6 py-3.5 bg-emerald-500 hover:bg-emerald-600 text-zinc-950 rounded-full font-bold transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                    Lihat Portfolio
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="{{ route('cv') }}" class="px-6 py-3.5 rounded-full font-bold transition-all border hover:scale-105 active:scale-95 flex items-center gap-2 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800 border-zinc-300 text-zinc-700 hover:bg-zinc-100">
                    <i class="fas fa-file-lines"></i> Lihat CV
                </a>
                <a href="#contact" class="px-6 py-3.5 rounded-full font-bold transition-all border hover:scale-105 active:scale-95 flex items-center gap-2 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800 border-zinc-300 text-zinc-700 hover:bg-zinc-100">
                    Hubungi Saya
                </a>
            </div>

            <div class="flex flex-wrap gap-2 mt-8">
                @foreach(array_slice(collect($skills->get('hard', []))->pluck('name')->all(), 0, 5) as $tech)
                <span class="text-[11px] px-2.5 py-1 rounded-md bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold">{{ $tech }}</span>
                @endforeach
            </div>
        </div>

        <div class="flex animate-on-scroll relative justify-center order-1 md:order-2 mb-8 md:mb-0" style="transition-delay: 150ms;">
            <div class="relative">
                <div class="absolute -inset-6 bg-emerald-500/15 blur-3xl rounded-full"></div>

                <div class="relative w-44 h-52 sm:w-56 sm:h-64 lg:w-80 lg:h-96 rounded-[2.5rem] overflow-hidden border-4 border-white dark:border-zinc-900 shadow-2xl shadow-emerald-500/10 rotate-2 hover:rotate-0 transition-transform duration-500">
                    @if($photo)
                    <img src="{{ $photo }}" alt="Foto {{ $siteProfile->name }}" class="w-full h-full object-cover object-top">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-emerald-500/10 text-emerald-500 text-6xl font-extrabold">
                        {{ strtoupper(substr($siteProfile->name ?? 'P', 0, 1)) }}
                    </div>
                    @endif
                    <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-zinc-950/70 to-transparent"></div>
                </div>

                <div class="absolute -bottom-5 -left-6 px-4 py-3 rounded-2xl backdrop-blur-xl bg-white/90 dark:bg-zinc-900/90 border dark:border-zinc-800 border-zinc-200 shadow-xl">
                    <p class="text-[10px] uppercase tracking-widest font-bold text-emerald-500">Fokus</p>
                    <p class="text-sm font-extrabold">{{ $siteProfile->headline ?? 'Frontend Developer' }}</p>
                </div>

                @if($siteProfile->class)
                <div class="absolute -top-4 -right-4 px-4 py-3 rounded-2xl backdrop-blur-xl bg-emerald-500 text-zinc-950 shadow-xl shadow-emerald-500/30">
                    <p class="text-[10px] uppercase tracking-widest font-bold opacity-70">Kelas</p>
                    <p class="text-sm font-extrabold">{{ $siteProfile->class }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
