<section id="contact" class="py-24 px-6 relative">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-emerald-500/5 to-transparent pointer-events-none"></div>
    <div class="max-w-5xl mx-auto">
        <div class="mb-16 animate-on-scroll text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">Mari Berdiskusi</h2>
            <p class="text-lg dark:text-zinc-400 text-zinc-500 max-w-xl mx-auto">Punya proyek menarik? Jangan ragu untuk menghubungi saya.</p>
        </div>

        <div class="contact-grid items-start">
            <div class="contact-left animate-on-scroll">
                <h3>Hubungi Saya</h3>
                <p>Saya selalu terbuka untuk diskusi tentang proyek baru, kolaborasi, atau sekadar berbincang tentang teknologi. Jangan sungkan menghubungi saya melalui form di samping atau media sosial di bawah ini.</p>
                <div class="social-links">
                    <a href="https://wa.me/6285941927406" target="_blank" class="social-link" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.instagram.com/gust1_rizky" target="_blank" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://github.com/Blazer62" target="_blank" class="social-link" aria-label="GitHub"><i class="fab fa-github"></i></a>
                    <a href="https://www.tiktok.com/@agus_9176" target="_blank" class="social-link" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    <a href="mailto:gustyrizkyananda@gmail.com" class="social-link" aria-label="Email"><i class="fas fa-envelope"></i></a>
                </div>
            </div>

            <div class="animate-on-scroll" style="transition-delay:100ms">
                <form class="contact-form" id="contactForm" method="POST" action="{{ route('contact.store') }}" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="contact_name">Nama Lengkap</label>
                        <input type="text" id="contact_name" name="contact_name" placeholder="Masukkan nama Anda" required />
                        <span class="form-error">Nama harus diisi</span>
                    </div>
                    <div class="form-group">
                        <label for="contact_email">Email</label>
                        <input type="email" id="contact_email" name="contact_email" placeholder="Masukkan email Anda" required />
                        <span class="form-error">Masukkan email yang valid</span>
                    </div>
                    <div class="form-group">
                        <label for="contact_message">Pesan</label>
                        <textarea id="contact_message" name="contact_message" placeholder="Tulis pesan Anda..." required></textarea>
                        <span class="form-error">Pesan harus diisi</span>
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
