<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gusti Rizky Ananda | Fullstack Developer</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        emerald: { 400: '#34d399', 500: '#10b981', 600: '#059669' },
                    },
                    fontFamily: { sans: ['Outfit', 'sans-serif'] }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    @include('partials.styles')
    @stack('styles')
</head>
<body class="bg-[#fafafa] text-zinc-900 dark:bg-zinc-950 dark:text-zinc-50 transition-colors duration-500 selection:bg-emerald-500 selection:text-white">

    @include('partials.particles')

    @if(session('success'))
    <div id="success-notif" class="fixed top-0 w-full bg-emerald-500 text-white p-3 text-center z-50 text-sm font-semibold">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function() {
            var el = document.getElementById('success-notif');
            if (el) { el.style.transition = 'opacity 0.5s'; el.style.opacity = '0'; setTimeout(function() { el.remove(); }, 500); }
        }, 4000);
    </script>
    @endif

    <div class="fixed top-0 left-0 right-0 z-50 loading-bar"></div>

    @include('partials.navbar')

    <button id="scrollTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})" class="fixed bottom-8 right-8 z-50 w-12 h-12 rounded-full bg-emerald-500 text-zinc-950 shadow-lg shadow-emerald-500/30 flex items-center justify-center hover:bg-emerald-600 hover:scale-110 active:scale-95 transition-all duration-300 opacity-0 invisible">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"></path></svg>
    </button>

    <main class="relative z-10">
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.project-modals')
    @include('partials.toast')
    @include('partials.scripts')

    @stack('scripts')
</body>
</html> 
