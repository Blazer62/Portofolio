<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title', 'Dashboard Admin')</title>
    <script>
        // Ikuti tema tersimpan (sama dengan halaman publik & login) agar tidak berkedip.
        if (localStorage.theme === 'light') {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: { emerald: { 400: '#34d399', 500: '#10b981', 600: '#059669' } },
                    fontFamily: { sans: ['Outfit', 'sans-serif'] }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        html { color-scheme: light; }
        html.dark { color-scheme: dark; }
        input::placeholder, textarea::placeholder { color: #a1a1aa; }
        html.dark input::placeholder, html.dark textarea::placeholder { color: #71717a; }
    </style>
</head>
<body class="bg-zinc-100 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-50 font-sans antialiased transition-colors duration-300">
@php
    try {
        $adminUnread = \App\Models\Message::where('is_read', false)->count();
    } catch (\Throwable $e) {
        $adminUnread = 0;
    }

    $adminNav = [
        ['admin.dashboard', 'Dashboard', 'fa-gauge-high'],
        ['admin.projects.index', 'Proyek', 'fa-folder-open'],
        ['admin.certificates.index', 'Sertifikat', 'fa-award'],
        ['admin.skills.index', 'Keahlian', 'fa-chart-simple'],
        ['admin.educations.index', 'Pendidikan', 'fa-graduation-cap'],
        ['admin.experiences.index', 'Pengalaman', 'fa-briefcase'],
        ['admin.testimonials.index', 'Testimoni', 'fa-comment-dots'],
        ['admin.posts.index', 'Blog', 'fa-pen-nib'],
        ['admin.messages.index', 'Pesan', 'fa-envelope'],
        ['admin.profile.edit', 'Profil', 'fa-user'],
    ];
@endphp

<aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-zinc-950 dark:bg-zinc-900 text-zinc-400 border-r border-zinc-900 dark:border-zinc-800 -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col">
    <div class="px-6 py-6 border-b border-zinc-900">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-emerald-500 text-zinc-950 flex items-center justify-center font-extrabold">G</span>
            <span>
                <span class="block text-white font-extrabold leading-tight">Admin Panel</span>
                <span class="block text-[11px] text-zinc-500">Portofolio</span>
            </span>
        </a>
    </div>

    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
        @foreach($adminNav as [$route, $label, $icon])
        <a href="{{ route($route) }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs($route) ? 'bg-emerald-500 text-zinc-950' : 'hover:bg-zinc-900 hover:text-white' }}">
            <i class="fas {{ $icon }} w-4 text-center text-xs"></i>
            <span>{{ $label }}</span>
            @if($route === 'admin.messages.index' && $adminUnread > 0)
            <span class="ml-auto text-[10px] font-extrabold px-2 py-0.5 rounded-full bg-red-500 text-white">{{ $adminUnread }}</span>
            @endif
        </a>
        @endforeach
    </nav>

    <div class="p-3 border-t border-zinc-900 space-y-1">
        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold hover:bg-zinc-900 hover:text-white transition-colors">
            <i class="fas fa-arrow-up-right-from-square w-4 text-center text-xs"></i> Lihat Website
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold hover:bg-red-500 hover:text-white transition-colors">
                <i class="fas fa-right-from-bracket w-4 text-center text-xs"></i> Logout
            </button>
        </form>
    </div>
</aside>

<div id="sidebarOverlay" class="fixed inset-0 bg-zinc-950/50 z-40 hidden lg:hidden"></div>

<div class="lg:pl-64 min-h-screen flex flex-col">
    <header class="sticky top-0 z-30 bg-white/90 dark:bg-zinc-950/90 backdrop-blur border-b border-zinc-200 dark:border-zinc-800 px-4 md:px-8 py-4 flex items-center justify-between gap-4">
        <div class="flex items-center gap-3 min-w-0">
            <button id="sidebarToggle" class="lg:hidden w-9 h-9 rounded-xl border border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-300 flex items-center justify-center">
                <i class="fas fa-bars text-sm"></i>
            </button>
            <div class="min-w-0">
                <h1 class="text-lg md:text-xl font-extrabold truncate">@yield('header', 'Dashboard')</h1>
                <p class="text-xs text-zinc-500 truncate">@yield('subheader', 'Kelola konten portofolio tanpa menyentuh kode.')</p>
            </div>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            @yield('actions')
            <button id="admin-theme-toggle" type="button" aria-label="Ganti mode warna"
                class="w-9 h-9 rounded-xl border border-zinc-200 dark:border-zinc-700 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-emerald-500 hover:border-emerald-400 transition-colors">
                <i id="admin-theme-sun" class="fas fa-sun text-sm"></i>
                <i id="admin-theme-moon" class="fas fa-moon text-sm hidden"></i>
            </button>
            <span class="hidden sm:flex items-center gap-2 pl-2 border-l border-zinc-200 dark:border-zinc-800">
                <span class="w-8 h-8 rounded-full bg-emerald-500 text-zinc-950 flex items-center justify-center text-xs font-extrabold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </span>
                <span class="text-xs font-bold">{{ auth()->user()->name ?? 'Admin' }}</span>
            </span>
        </div>
    </header>

    <main class="flex-1 p-4 md:p-8">
        <div class="max-w-6xl mx-auto">
            @if(session('success'))
            <div class="mb-5 rounded-2xl border border-emerald-200 dark:border-emerald-500/30 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 px-4 py-3 text-sm font-semibold flex items-center gap-2">
                <i class="fas fa-circle-check"></i> {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-5 rounded-2xl border border-red-200 dark:border-red-500/30 bg-red-50 dark:bg-red-500/10 text-red-700 dark:text-red-300 px-4 py-3 text-sm font-semibold">
                <p class="mb-1"><i class="fas fa-triangle-exclamation mr-1"></i> Periksa kembali isian berikut:</p>
                <ul class="list-disc list-inside text-xs space-y-0.5">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
        </div>
    </main>
</div>

<script>
(function() {
    var sidebar = document.getElementById('sidebar');
    var overlay = document.getElementById('sidebarOverlay');
    var button = document.getElementById('sidebarToggle');
    if (!sidebar || !overlay || !button) return;

    function open() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
    }
    function close() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    }

    button.addEventListener('click', open);
    overlay.addEventListener('click', close);
})();

/* Mode gelap / terang untuk halaman admin */
(function() {
    var html = document.documentElement;
    var toggle = document.getElementById('admin-theme-toggle');
    var sun = document.getElementById('admin-theme-sun');
    var moon = document.getElementById('admin-theme-moon');
    if (!toggle || !sun || !moon) return;

    function syncIcons() {
        var dark = html.classList.contains('dark');
        sun.classList.toggle('hidden', !dark);
        moon.classList.toggle('hidden', dark);
    }

    syncIcons();

    toggle.addEventListener('click', function() {
        html.classList.toggle('dark');
        localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
        syncIcons();
    });
})();
</script>
@stack('scripts')
</body>
</html>
