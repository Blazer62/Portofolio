@php
    $photo = \App\Support\Media::url($siteProfile->photo ?? null);
    $interestList = method_exists($siteProfile, 'interestList') ? $siteProfile->interestList() : [];
    $projectCount = $projects->count();
    $certificateCount = $certificates->count();
    $experienceCount = $experiences->flatten(1)->count();
    $skillCount = $skills->flatten(1)->count();
@endphp

<section id="about" class="py-24 md:py-32 px-6 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-500/5 rounded-full blur-[100px]"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-emerald-500/5 rounded-full blur-[80px]"></div>

    <div class="max-w-6xl mx-auto">
        <div class="animate-on-scroll mb-14">
            <span class="section-kicker mb-4">Tentang Saya</span>
            <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight">Kenali Saya Lebih Dekat</h2>
        </div>

        <div class="grid md:grid-cols-5 gap-10 items-start">
            <div class="md:col-span-2 animate-on-scroll">
                <div class="rounded-[2rem] overflow-hidden border dark:border-zinc-800 border-zinc-200 dark:bg-zinc-900 bg-white p-3 shadow-lg">
                    @if($photo)
                    <img src="{{ $photo }}" alt="Foto {{ $siteProfile->name }}" class="w-full rounded-[1.5rem] object-cover aspect-[4/5] object-top">
                    @else
                    <div class="w-full aspect-[4/5] rounded-[1.5rem] bg-emerald-500/10 flex items-center justify-center text-6xl font-extrabold text-emerald-500">
                        {{ strtoupper(substr($siteProfile->name ?? 'P', 0, 1)) }}
                    </div>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-3 mt-5">
                    <div class="rounded-2xl border dark:border-zinc-800 border-zinc-200 p-4 dark:bg-zinc-900/60 bg-white">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-emerald-500 mb-1">Kelas</p>
                        <p class="text-sm font-bold">{{ $siteProfile->class ?: '-' }}</p>
                    </div>
                    <div class="rounded-2xl border dark:border-zinc-800 border-zinc-200 p-4 dark:bg-zinc-900/60 bg-white">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-emerald-500 mb-1">Sekolah</p>
                        <p class="text-sm font-bold">{{ $siteProfile->school ?: '-' }}</p>
                    </div>
                </div>

                <div class="flex gap-2 mt-4">
                    @foreach([
                        ['fab', 'fa-github', 'GitHub', $siteProfile->github ?? null],
                        ['fab', 'fa-instagram', 'Instagram', $siteProfile->instagram ?? null],
                        ['fab', 'fa-whatsapp', 'WhatsApp', $siteProfile->whatsapp ?? null],
                        ['fas', 'fa-envelope', 'Email', ! empty($siteProfile->email) ? 'mailto:'.$siteProfile->email : null],
                    ] as [$style, $icon, $label, $url])
                        @if($url)
                        <a href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ $label }}"
                            class="w-10 h-10 rounded-full border flex items-center justify-center dark:border-zinc-800 border-zinc-300 dark:text-zinc-400 text-zinc-600 hover:border-emerald-500 hover:text-emerald-500 transition-colors">
                            <i class="{{ $style }} {{ $icon }}"></i>
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="md:col-span-3 animate-on-scroll" style="transition-delay:120ms">
                <p class="text-lg md:text-xl leading-relaxed dark:text-zinc-200 text-zinc-800 font-medium mb-5">
                    {{ $siteProfile->bio ?? 'Deskripsi singkat tentang saya.' }}
                </p>

                <div class="grid grid-cols-2 gap-3 mb-6">
                    <div class="rounded-2xl border dark:border-zinc-800 border-zinc-200 p-4 dark:bg-zinc-900/40 bg-white">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-emerald-500 mb-1">Nama Lengkap</p>
                        <p class="text-sm font-bold">{{ $siteProfile->name ?? '-' }}</p>
                    </div>
                    <div class="rounded-2xl border dark:border-zinc-800 border-zinc-200 p-4 dark:bg-zinc-900/40 bg-white">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-emerald-500 mb-1">Kompetensi</p>
                        <p class="text-sm font-bold">{{ $siteProfile->major ?? '-' }}</p>
                    </div>
                    <div class="rounded-2xl border dark:border-zinc-800 border-zinc-200 p-4 dark:bg-zinc-900/40 bg-white">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-emerald-500 mb-1">Domisili</p>
                        <p class="text-sm font-bold">{{ $siteProfile->location ?? '-' }}</p>
                    </div>
                    <div class="rounded-2xl border dark:border-zinc-800 border-zinc-200 p-4 dark:bg-zinc-900/40 bg-white">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-emerald-500 mb-1">Email</p>
                        <p class="text-sm font-bold break-all">{{ $siteProfile->email ?? '-' }}</p>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-3">Minat &amp; Bidang Teknologi</h3>
                    <div class="flex flex-wrap gap-2">
                        @forelse($interestList as $interest)
                        <span class="px-3 py-1.5 rounded-full text-xs font-bold dark:bg-zinc-900 bg-white border dark:border-zinc-800 border-zinc-200 dark:text-zinc-300 text-zinc-600">{{ $interest }}</span>
                        @empty
                        <span class="text-sm dark:text-zinc-500 text-zinc-500">Belum diisi.</span>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-2xl border border-emerald-500/25 bg-emerald-500/5 p-5">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-2">Cita-cita &amp; Tujuan Karir</h3>
                    <p class="text-sm leading-relaxed dark:text-zinc-300 text-zinc-700">{{ $siteProfile->career_goal ?? 'Belum diisi.' }}</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6">
                    <div class="stat-card">
                        <div class="stat-num"><span class="counter" data-target="{{ $projectCount }}">0</span></div>
                        <div class="stat-label">Proyek</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-num"><span class="counter" data-target="{{ $certificateCount }}">0</span></div>
                        <div class="stat-label">Sertifikat</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-num"><span class="counter" data-target="{{ $experienceCount }}">0</span></div>
                        <div class="stat-label">Pengalaman</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-num"><span class="counter" data-target="{{ $skillCount }}">0</span></div>
                        <div class="stat-label">Keahlian</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-10 mt-20 animate-on-scroll">
            <div>
                <span class="section-kicker mb-4">Pendidikan</span>
                <h3 class="text-2xl md:text-3xl font-extrabold tracking-tight">Riwayat Pendidikan</h3>
                <p class="text-sm dark:text-zinc-400 text-zinc-600 mt-3">Perjalanan belajar dari sekolah dasar hingga jurusan yang saya tekuni sekarang.</p>
            </div>
            <div class="md:col-span-2">
                <div class="timeline">
                    @forelse($educations as $education)
                    <div class="timeline-item">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <h4 class="font-extrabold">{{ $education->institution }}</h4>
                            <span class="text-[10px] font-bold uppercase tracking-widest px-2 py-0.5 rounded-md bg-emerald-500/10 text-emerald-500">{{ $education->level }}</span>
                        </div>
                        <p class="text-sm font-semibold dark:text-zinc-300 text-zinc-700">
                            {{ $education->major ?: 'Umum' }}
                            <span class="dark:text-zinc-500 text-zinc-500 font-normal">• {{ $education->start_year }} – {{ $education->end_year }}</span>
                        </p>
                        @if($education->description)
                        <p class="text-sm mt-2 leading-relaxed dark:text-zinc-400 text-zinc-600">{{ $education->description }}</p>
                        @endif
                    </div>
                    @empty
                    <p class="text-sm dark:text-zinc-500 text-zinc-500">Belum ada data pendidikan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
