@php
    $waDigits = $siteProfile->whatsapp ? preg_replace('/\D+/', '', $siteProfile->whatsapp) : null;
    $waDisplay = null;

    if ($waDigits) {
        $local = str_starts_with($waDigits, '62') ? substr($waDigits, 2) : $waDigits;
        $waDisplay = '+62 '.substr($local, 0, 3).'-'.substr($local, 3, 4).'-'.substr($local, 7);
    }

    $contactItems = [
        ['fas', 'fa-envelope', 'Email', $siteProfile->email ?? null, ! empty($siteProfile->email) ? 'mailto:'.$siteProfile->email : null],
        ['fab', 'fa-whatsapp', 'WhatsApp', $waDisplay, $siteProfile->whatsapp ?? null],
        ['fab', 'fa-github', 'GitHub', $siteProfile->github ? preg_replace('#^https?://(www\.)?#', '', rtrim($siteProfile->github, '/')) : null, $siteProfile->github ?? null],
        ['fab', 'fa-instagram', 'Instagram', $siteProfile->instagram ? '@'.ltrim(basename(rtrim($siteProfile->instagram, '/')), '@') : null, $siteProfile->instagram ?? null],
    ];
@endphp

<section id="contact" class="py-24 px-6 relative">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-emerald-500/5 to-transparent pointer-events-none"></div>
    <div class="max-w-6xl mx-auto relative">
        <div class="mb-14 animate-on-scroll text-center">
            <span class="section-kicker mb-4 justify-center">Kontak</span>
            <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">Mari Berdiskusi</h2>
            <p class="text-base md:text-lg dark:text-zinc-400 text-zinc-500 max-w-xl mx-auto">Punya pertanyaan, tawaran kolaborasi, atau ingin berbagi ide? Kirim pesan lewat form atau media sosial di bawah.</p>
        </div>

        <div class="contact-grid items-start">
            <div class="contact-left animate-on-scroll">
                <h3>Hubungi Saya</h3>
                <p>Saya selalu terbuka untuk diskusi tentang proyek baru, kolaborasi, atau sekadar berbincang tentang teknologi dan desain antarmuka.</p>

                <div class="space-y-3 mb-8">
                    @foreach($contactItems as [$style, $icon, $label, $value, $url])
                        @if($url)
                        <a href="{{ $url }}" target="_blank" rel="noopener"
                            class="flex items-center gap-3 rounded-2xl border dark:border-zinc-800 border-zinc-200 dark:bg-zinc-900/60 bg-white px-4 py-3 hover:border-emerald-500 transition-colors group">
                            <span class="w-9 h-9 rounded-full bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                                <i class="{{ $style }} {{ $icon }}"></i>
                            </span>
                            <span class="min-w-0">
                                <span class="block text-[10px] uppercase tracking-widest font-bold dark:text-zinc-500 text-zinc-500">{{ $label }}</span>
                                <span class="block text-sm font-bold truncate group-hover:text-emerald-500 transition-colors">{{ $value }}</span>
                            </span>
                        </a>
                        @endif
                    @endforeach
                </div>

                <div class="social-links">
                    @if($siteProfile->whatsapp)
                    <a href="{{ $siteProfile->whatsapp }}" target="_blank" class="social-link" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    @endif
                    @if($siteProfile->instagram)
                    <a href="{{ $siteProfile->instagram }}" target="_blank" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if($siteProfile->github)
                    <a href="{{ $siteProfile->github }}" target="_blank" class="social-link" aria-label="GitHub"><i class="fab fa-github"></i></a>
                    @endif
                    @if($siteProfile->email)
                    <a href="mailto:{{ $siteProfile->email }}" class="social-link" aria-label="Email"><i class="fas fa-envelope"></i></a>
                    @endif
                </div>
            </div>

            <div class="animate-on-scroll" style="transition-delay:100ms">
                <form class="contact-form rounded-[2rem] border dark:bg-zinc-900 dark:border-zinc-800 bg-white border-zinc-200 p-6 md:p-7" id="contactForm" method="POST" action="{{ route('contact.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="contact_name">Nama Lengkap</label>
                        <input type="text" id="contact_name" name="contact_name" value="{{ old('contact_name') }}" placeholder="Masukkan nama Anda" required />
                    </div>
                    <div class="form-group">
                        <label for="contact_email">Email</label>
                        <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email') }}" placeholder="Masukkan email Anda" required />
                    </div>
                    <div class="form-group">
                        <label for="contact_message">Pesan</label>
                        <textarea id="contact_message" name="contact_message" placeholder="Tulis pesan Anda..." required>{{ old('contact_message') }}</textarea>
                    </div>
                    <button type="submit" class="btn-submit">
                        <span class="btn-text"><i class="fas fa-paper-plane"></i> Kirim Pesan</span>
                        <span class="spinner"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
