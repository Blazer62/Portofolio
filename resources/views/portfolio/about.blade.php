<section id="about" class="py-32 px-6 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-500/5 rounded-full blur-[100px]"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-emerald-500/5 rounded-full blur-[80px]"></div>

    <div class="max-w-5xl mx-auto">
        <div class="animate-on-scroll mb-14">
            <div class="flex items-center gap-4 mb-4">
                <span class="w-12 h-1 bg-emerald-500 rounded-full"></span>
                <span class="text-emerald-500 font-semibold text-sm uppercase tracking-widest">Tentang Saya</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight">Kenali Saya Lebih Dekat</h2>
        </div>

        <div class="grid md:grid-cols-5 gap-10 items-center">
            <div class="md:col-span-2 animate-on-scroll flex flex-col items-center justify-center gap-6">
                <img src="{{ asset('images/fotogunung.jpeg') }}" alt="Foto Saya" class="w-full max-w-xs rounded-2xl shadow-lg object-cover aspect-square">
            </div>

            <div class="md:col-span-3 animate-on-scroll" style="transition-delay:150ms">
                <p class="text-xl md:text-2xl leading-relaxed dark:text-zinc-200 text-zinc-800 font-medium mb-6">
                    Saya menguasai seluruh spektrum pengembangan web. Dari merancang struktur <span class="text-emerald-500 font-semibold">database MySQL</span> yang efisien, membangun logika bisnis dengan <span class="text-emerald-500 font-semibold">PHP & Laravel</span>, hingga menciptakan antarmuka dinamis dengan <span class="text-emerald-500 font-semibold">HTML, CSS, dan Javascript</span>.
                </p>
                <p class="dark:text-zinc-400 text-zinc-600 mb-10 italic border-l-4 border-emerald-500/50 pl-5">
                    Saya percaya bahwa teknologi adalah alat untuk memecahkan masalah nyata. Setiap baris kode yang saya tulis adalah langkah menuju solusi yang lebih baik.
                </p>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="stat-card">
                        <div class="stat-num"><span class="counter" data-target="3">0</span>+</div>
                        <div class="stat-label">Proyek Selesai</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-num"><span class="counter" data-target="2">0</span>+</div>
                        <div class="stat-label">Klien Puas</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-num"><span class="counter" data-target="1">0</span>+</div>
                        <div class="stat-label">Tahun Pengalaman</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-num"><span class="counter" data-target="6">0</span>+</div>
                        <div class="stat-label">Teknologi Dikuasai</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
