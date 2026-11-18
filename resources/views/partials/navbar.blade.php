@php
    $navLinks = [
        ['#beranda', 'Beranda'],
        ['#about', 'Tentang'],
        ['#skills', 'Skill'],
        ['#projects', 'Proyek'],
        ['#experience', 'Pengalaman'],
        ['#testimonials', 'Testimoni'],
        ['#blog', 'Blog'],
        ['#contact', 'Kontak'],
    ];
    $photo = \App\Support\Media::url($siteProfile->photo ?? null);
    $isHome = request()->routeIs('home');
@endphp

<div class="no-print fixed top-4 md:top-6 left-0 right-0 z-50 flex flex-col items-center px-4 pointer-events-none">
    <nav class="pointer-events-auto flex items-center justify-between gap-4 px-4 md:px-6 py-2.5 md:py-3 rounded-full backdrop-blur-xl border transition-all duration-300 w-full max-w-6xl bg-white/80 border-zinc-200 shadow-zinc-200/50 dark:bg-zinc-900/70 dark:border-zinc-800 dark:shadow-black/20 shadow-lg">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 min-w-0">
            @if($photo)
            <img src="{{ $photo }}" alt="{{ $siteProfile->name }}" class="w-9 h-9 rounded-full object-cover ring-2 ring-emerald-500/40">
            @else
            <span class="w-9 h-9 rounded-full bg-emerald-500 text-zinc-950 flex items-center justify-center font-extrabold">
                {{ strtoupper(substr($siteProfile->name ?? 'P', 0, 1)) }}
            </span>
            @endif
            <span class="text-[13px] md:text-base font-extrabold tracking-tight whitespace-nowrap truncate max-w-[135px] sm:max-w-[190px] md:max-w-none">
                {{ $siteProfile->name ?? 'Portofolio' }}
            </span>
        </a>

        <div class="hidden lg:flex items-center gap-1">
            @foreach($navLinks as [$href, $label])
            <a href="{{ $isHome ? $href : route('home').$href }}"
                class="px-3.5 py-2 text-sm font-medium rounded-full transition-all dark:text-zinc-400 dark:hover:text-white dark:hover:bg-zinc-800/60 text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100/70">
                {{ $label }}
            </a>
            @endforeach
        </div>

        <div class="flex items-center gap-1 shrink-0">
            <a href="{{ route('cv') }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 transition-colors">
                CV
            </a>
            <button id="theme-toggle" aria-label="Ganti mode warna" class="p-2.5 rounded-full transition-colors dark:hover:bg-zinc-800 text-zinc-500 dark:text-zinc-400 hover:text-emerald-500">
                <svg id="moon-icon" class="hidden w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                <svg id="sun-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </button>
            @auth
            <a href="{{ route('admin.dashboard') }}" class="p-2.5 rounded-full transition-colors dark:hover:bg-zinc-800 text-zinc-500 dark:text-zinc-400 hover:text-emerald-500" title="Dashboard admin">
                <i class="fas fa-gauge-high"></i>
            </a>
            @endauth
            <button id="menu-toggle" class="lg:hidden p-2.5 rounded-full transition-colors dark:hover:bg-zinc-800 text-zinc-500 dark:text-zinc-400 hover:text-emerald-500" aria-label="Menu">
                <svg id="menu-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <svg id="close-icon" class="hidden w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </nav>

    <div id="mobile-menu" class="lg:hidden pointer-events-auto w-full max-w-6xl mt-3 rounded-2xl border backdrop-blur-xl transition-all duration-300 bg-white/95 border-zinc-200 dark:bg-zinc-950/95 dark:border-zinc-800 shadow-xl" style="display:none;">
        <div class="p-3 grid grid-cols-2 gap-1">
            @foreach($navLinks as [$href, $label])
            <a href="{{ $isHome ? $href : route('home').$href }}" class="mobile-link block px-4 py-3 rounded-xl text-sm font-semibold transition-colors dark:text-zinc-200 dark:hover:bg-zinc-800/80 text-zinc-700 hover:bg-emerald-50 hover:text-emerald-600">{{ $label }}</a>
            @endforeach
            <a href="{{ route('cv') }}" class="mobile-link block px-4 py-3 rounded-xl text-sm font-semibold bg-emerald-500 text-zinc-950">Lihat CV</a>
            @auth
            <a href="{{ route('admin.dashboard') }}" class="mobile-link block px-4 py-3 rounded-xl text-sm font-semibold dark:text-zinc-200 dark:hover:bg-zinc-800/80 text-zinc-700 hover:bg-emerald-50 hover:text-emerald-600">Dashboard</a>
            @endauth
        </div>
    </div>
</div>
