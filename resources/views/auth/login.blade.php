<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin</title>
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
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .bg-pattern {
            background-image: radial-gradient(rgba(16, 185, 129, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
</head>
<body class="bg-[#fafafa] text-zinc-900 dark:bg-zinc-950 dark:text-zinc-50 bg-pattern min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold">Login Admin</h1>
            <p class="dark:text-zinc-400 text-zinc-500 mt-2">Masuk untuk mengelola project</p>
        </div>

        <div class="rounded-[2rem] shadow-2xl p-8 border dark:bg-zinc-900 dark:border-zinc-800 bg-white border-zinc-200">
            @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-500 font-medium text-sm">
                {{ $errors->first('email') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-emerald-500 outline-none transition-all dark:bg-zinc-950 dark:border-zinc-800 bg-zinc-50 border-zinc-300"
                        placeholder="admin@admin.com" />
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-emerald-500 outline-none transition-all dark:bg-zinc-950 dark:border-zinc-800 bg-zinc-50 border-zinc-300"
                        placeholder="••••••••" />
                </div>
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-zinc-950 font-bold transition-colors shadow-lg shadow-emerald-500/20">
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-sm dark:text-zinc-400 text-zinc-500 hover:text-emerald-500 transition-colors">
                    &larr; Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
