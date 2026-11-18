@php
    $hardSkills = $skills->get('hard', collect());
    $softSkills = $skills->get('soft', collect());
    $tools = ['Visual Studio Code', 'Git & GitHub', 'Figma', 'XAMPP', 'Vercel'];
@endphp

<section id="skills" class="py-24 px-6 relative">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-emerald-500/[0.03] to-transparent pointer-events-none"></div>

    <div class="max-w-6xl mx-auto relative">
        <div class="animate-on-scroll mb-12 flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="section-kicker mb-4">Keahlian</span>
                <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight">Hard Skill &amp; Soft Skill</h2>
            </div>
            <p class="text-sm dark:text-zinc-400 text-zinc-600 max-w-xs">Persentase ini gambaran tingkat kenyamanan saya memakai teknologi tersebut, bukan nilai mutlak.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <div class="animate-on-scroll rounded-[2rem] p-7 md:p-8 border dark:bg-zinc-900 dark:border-zinc-800 bg-white border-zinc-200 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-11 h-11 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-extrabold">Technical Skill</h3>
                        <p class="text-xs dark:text-zinc-500 text-zinc-500">Kemampuan teknis</p>
                    </div>
                </div>

                <div class="space-y-5">
                    @forelse($hardSkills as $skill)
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-sm font-bold">{{ $skill->name }}</span>
                            <span class="text-xs font-bold text-emerald-500">{{ $skill->percentage }}%</span>
                        </div>
                        <div class="skill-track">
                            <span class="skill-fill" data-width="{{ max(0, min(100, $skill->percentage)) }}"></span>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm dark:text-zinc-500 text-zinc-500">Belum ada data keahlian teknis.</p>
                    @endforelse
                </div>
            </div>

            <div class="animate-on-scroll rounded-[2rem] p-7 md:p-8 border dark:bg-zinc-900 dark:border-zinc-800 bg-white border-zinc-200 shadow-sm" style="transition-delay:100ms">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-11 h-11 rounded-xl bg-emerald-500 text-zinc-950 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-extrabold">Soft Skill</h3>
                        <p class="text-xs dark:text-zinc-500 text-zinc-500">Kemampuan non-teknis</p>
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-3">
                    @forelse($softSkills as $skill)
                    <div class="rounded-2xl border dark:border-zinc-800 border-zinc-200 dark:bg-zinc-950/60 bg-zinc-50 p-4">
                        <div class="flex items-end justify-between mb-2">
                            <span class="text-sm font-bold">{{ $skill->name }}</span>
                            <span class="text-lg font-extrabold text-emerald-500 leading-none">{{ $skill->percentage }}%</span>
                        </div>
                        <div class="skill-track">
                            <span class="skill-fill" data-width="{{ max(0, min(100, $skill->percentage)) }}"></span>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm dark:text-zinc-500 text-zinc-500">Belum ada data soft skill.</p>
                    @endforelse
                </div>

                <div class="mt-7">
                    <h4 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-3">Tools yang Dipakai</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tools as $tool)
                        <span class="px-3 py-1.5 rounded-lg text-xs font-bold dark:bg-zinc-800 dark:text-zinc-300 bg-zinc-100 text-zinc-700">{{ $tool }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
