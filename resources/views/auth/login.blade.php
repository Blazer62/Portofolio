<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Login Admin | {{ $siteProfile->name ?? 'Portofolio' }}</title>
    <script>
        if (localStorage.theme === 'light') document.documentElement.classList.remove('dark');
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
        body { font-family: 'Outfit', sans-serif; }
        .bg-pattern {
            background-image: radial-gradient(rgba(16, 185, 129, 0.12) 1px, transparent 1px);
            background-size: 28px 28px;
        }
    </style>
</head>
<body class="bg-[#fafafa] text-zinc-900 dark:bg-zinc-950 dark:text-zinc-50 bg-pattern min-h-screen flex items-center justify-center p-4">
    <button id="theme-toggle" aria-label="Ganti mode" class="fixed top-5 right-5 w-11 h-11 rounded-full border dark:border-zinc-800 border-zinc-200 dark:bg-zinc-900 bg-white flex items-center justify-center dark:text-zinc-400 text-zinc-600 hover:text-emerald-500 transition-colors">
        <i class="fas fa-circle-half-stroke"></i>
    </button>

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <span class="inline-flex w-14 h-14 rounded-2xl bg-emerald-500 text-zinc-950 items-center justify-center text-2xl font-extrabold shadow-lg shadow-emerald-500/30 mb-4">G</span>
            <h1 class="text-3xl font-extrabold tracking-tight">Login Admin</h1>
            <p class="dark:text-zinc-400 text-zinc-500 mt-2 text-sm">Masuk untuk mengelola konten portofolio.</p>
        </div>

        <div class="rounded-[2rem] shadow-2xl p-8 border dark:bg-zinc-900 dark:border-zinc-800 bg-white border-zinc-200">
            @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-500 font-medium text-sm">
                <i class="fas fa-triangle-exclamation mr-1"></i> {{ $errors->first('email') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-emerald-500 outline-none transition-all dark:bg-zinc-950 dark:border-zinc-800 dark:text-white bg-zinc-50 border-zinc-300"
                        placeholder="nama@email.com" />
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Password</label>
                    <input type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-emerald-500 outline-none transition-all dark:bg-zinc-950 dark:border-zinc-800 dark:text-white bg-zinc-50 border-zinc-300"
                        placeholder="••••••••" />
                </div>
                <label class="flex items-center gap-2 text-sm dark:text-zinc-400 text-zinc-600">
                    <input type="checkbox" name="remember" value="1" class="w-4 h-4 rounded border-zinc-300 text-emerald-500 focus:ring-emerald-500">
                    Ingat saya
                </label>
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-zinc-950 font-bold transition-colors shadow-lg shadow-emerald-500/20">
                    <i class="fas fa-right-to-bracket mr-1"></i> Masuk
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-sm dark:text-zinc-400 text-zinc-500 hover:text-emerald-500 transition-colors">
                    &larr; Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('theme-toggle').addEventListener('click', function () {
            var html = document.documentElement;
            html.classList.toggle('dark');
            localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
        });
    </script>
</body>
</html>
