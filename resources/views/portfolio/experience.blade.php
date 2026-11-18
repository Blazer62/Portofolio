@php
    $groups = [
        'plk' => ['label' => 'Pengalaman PLK', 'icon' => 'fa-briefcase'],
        'organisasi' => ['label' => 'Organisasi & Kepanitiaan', 'icon' => 'fa-users'],
        'lomba' => ['label' => 'Pengalaman Lomba', 'icon' => 'fa-trophy'],
    ];

    $visibleGroups = collect($groups)->filter(
        fn ($meta, $type) => $experiences->get($type, collect())->isNotEmpty()
    );

    $gridClass = match ($visibleGroups->count()) {
        1 => 'max-w-2xl',
        2 => 'md:grid-cols-2',
        default => 'md:grid-cols-3',
    };
@endphp

<section id="experience" class="py-24 px-6 relative">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-emerald-500/[0.03] to-transparent pointer-events-none"></div>

    <div class="max-w-6xl mx-auto relative">
        <div class="animate-on-scroll mb-12">
            <span class="section-kicker mb-4">Pengalaman</span>
            <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight">Pengalaman &amp; Perjalanan</h2>
            <p class="text-sm dark:text-zinc-400 text-zinc-600 mt-2 max-w-xl">Pengalaman praktik kerja lapangan dan kerja tim yang membentuk cara saya bekerja.</p>
        </div>

        <div class="grid {{ $gridClass }} gap-6">
            @forelse($visibleGroups as $type => $meta)
            <div class="animate-on-scroll rounded-[2rem] border dark:bg-zinc-900 dark:border-zinc-800 bg-white border-zinc-200 p-6 shadow-sm" style="transition-delay: {{ $loop->index * 90 }}ms">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                        <i class="fas {{ $meta['icon'] }}"></i>
                    </div>
                    <h3 class="font-extrabold leading-tight">{{ $meta['label'] }}</h3>
                </div>

                <div class="timeline">
                    @forelse($experiences->get($type, collect()) as $experience)
                    <div class="timeline-item">
                        <h4 class="font-bold text-sm leading-snug">{{ $experience->title }}</h4>
                        @if($experience->organization)
                        <p class="text-xs font-semibold text-emerald-500 mt-0.5">{{ $experience->organization }}</p>
                        @endif
                        @if($experience->period)
                        <p class="text-[11px] dark:text-zinc-500 text-zinc-500 mt-0.5">{{ $experience->period }}</p>
                        @endif
                        @if($experience->description)
                            @php
                                $descLines = collect(preg_split('/\r\n|\r|\n/', (string) $experience->description))
                                    ->map(fn($line) => trim($line))
                                    ->filter();
                                $hasBullets = $descLines->isNotEmpty() && $descLines->contains(fn($l) => str_starts_with($l, '-') || str_starts_with($l, '•'));
                            @endphp
                            @if($hasBullets)
                            <ul class="mt-2 space-y-1.5 text-xs leading-relaxed dark:text-zinc-400 text-zinc-600">
                                @foreach($descLines as $line)
                                <li class="flex items-start gap-2">
                                    <span class="text-emerald-500 font-bold shrink-0 mt-[1px]">•</span>
                                    <span>{{ ltrim($line, "-• \t") }}</span>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <p class="text-xs leading-relaxed dark:text-zinc-400 text-zinc-600 mt-2">{{ $experience->description }}</p>
                            @endif
                        @endif
                    </div>
                    @empty
                    <p class="text-xs dark:text-zinc-500 text-zinc-500">Belum ada data.</p>
                    @endforelse
                </div>
            </div>
            @empty
            <div class="text-center py-16 rounded-[2rem] border-2 border-dashed dark:border-zinc-800 dark:text-zinc-600 border-zinc-300 text-zinc-400 md:col-span-3">
                <i class="fas fa-briefcase text-4xl mb-3 opacity-60"></i>
                <p class="font-semibold">Belum ada pengalaman yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
