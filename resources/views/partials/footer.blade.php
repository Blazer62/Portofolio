@php
    $socials = [
        ['fab', 'fa-github', 'GitHub', $siteProfile->github ?? null],
        ['fab', 'fa-instagram', 'Instagram', $siteProfile->instagram ?? null],
        ['fab', 'fa-whatsapp', 'WhatsApp', $siteProfile->whatsapp ?? null],
        ['fas', 'fa-envelope', 'Email', ! empty($siteProfile->email) ? 'mailto:'.$siteProfile->email : null],
    ];
@endphp

<footer class="no-print mt-10 pt-14 pb-10 border-t dark:border-zinc-800/60 border-zinc-200 relative z-10">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-10">
        <div>
            <h3 class="text-xl font-extrabold mb-2">{{ $siteProfile->name ?? 'Portofolio' }}</h3>
            <p class="text-sm leading-relaxed dark:text-zinc-400 text-zinc-600 max-w-xs">
                {{ $siteProfile->tagline ?? 'Frontend developer yang fokus pada antarmuka web yang rapi dan responsif.' }}
            </p>
        </div>

        <div>
            <h4 class="text-sm font-bold uppercase tracking-widest text-emerald-500 mb-4">Navigasi</h4>
            <div class="grid grid-cols-2 gap-2 text-sm">
                <a href="{{ route('home') }}#projects" class="dark:text-zinc-400 text-zinc-600 hover:text-emerald-500 transition-colors">Proyek</a>
                <a href="{{ route('home') }}#certificates" class="dark:text-zinc-400 text-zinc-600 hover:text-emerald-500 transition-colors">Sertifikat</a>
                <a href="{{ route('home') }}#experience" class="dark:text-zinc-400 text-zinc-600 hover:text-emerald-500 transition-colors">Pengalaman</a>
                <a href="{{ route('home') }}#testimonials" class="dark:text-zinc-400 text-zinc-600 hover:text-emerald-500 transition-colors">Testimoni</a>
                <a href="{{ route('blog.index') }}" class="dark:text-zinc-400 text-zinc-600 hover:text-emerald-500 transition-colors">Blog</a>
                <a href="{{ route('cv') }}" class="dark:text-zinc-400 text-zinc-600 hover:text-emerald-500 transition-colors">CV Digital</a>
                <a href="{{ route('home') }}#contact" class="dark:text-zinc-400 text-zinc-600 hover:text-emerald-500 transition-colors">Kontak</a>
            </div>
        </div>

        <div>
            <h4 class="text-sm font-bold uppercase tracking-widest text-emerald-500 mb-4">Terhubung</h4>
            <div class="flex flex-wrap gap-3">
                @foreach($socials as [$style, $icon, $label, $url])
                    @if($url)
                    <a href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ $label }}"
                        class="w-10 h-10 rounded-full border flex items-center justify-center transition-all hover:-translate-y-1 hover:border-emerald-500 hover:text-emerald-500 dark:border-zinc-800 border-zinc-300 dark:text-zinc-400 text-zinc-600">
                        <i class="{{ $style }} {{ $icon }}"></i>
                    </a>
                    @endif
                @endforeach
            </div>
            <p class="text-xs dark:text-zinc-500 text-zinc-500 mt-6">&copy; {{ date('Y') }} {{ $siteProfile->name ?? '' }}. Dibuat dengan Laravel &amp; Tailwind CSS.</p>
        </div>
    </div>
</footer>
