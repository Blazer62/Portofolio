@php
    $allTech = $projects->flatMap(fn ($project) => $project->techList())->unique()->sort()->values();
@endphp

<section id="projects" class="py-24 px-6 relative">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-wrap justify-between items-end gap-4 mb-8 animate-on-scroll">
            <div>
                <span class="section-kicker mb-4">Galeri Projek</span>
                <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight">My Project</h2>
                <p class="text-sm dark:text-zinc-400 text-zinc-500 mt-2">Kumpulan proyek yang saya kerjakan, lengkap dengan proses dan hasilnya.</p>
            </div>
            <span class="px-4 py-2 rounded-full text-xs font-bold border dark:border-zinc-800 border-zinc-200 dark:text-zinc-300 text-zinc-600">
                {{ $projects->count() }} proyek
            </span>
        </div>

        <div class="animate-on-scroll mb-8 flex flex-col lg:flex-row lg:items-center gap-4">
            <div class="relative w-full lg:max-w-xs">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400 text-sm"></i>
                <input id="projectSearch" type="search" placeholder="Cari proyek atau teknologi..."
                    class="w-full pl-10 pr-4 py-3 rounded-full border text-sm outline-none transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 dark:bg-zinc-900 dark:border-zinc-800 bg-white border-zinc-200">
            </div>
            <div class="flex flex-wrap gap-2">
                <button class="filter-btn active" data-filter="all">Semua</button>
                @foreach($allTech as $tech)
                <button class="filter-btn" data-filter="{{ $tech }}">{{ $tech }}</button>
                @endforeach
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            @forelse($projects as $project)
            @php
                $image = \App\Support\Media::url($project->image) ?? \App\Support\Media::url($project->image_url);
                $payload = [
                    'title' => $project->title,
                    'category' => $project->category,
                    'description' => $project->description,
                    'problem' => $project->problem,
                    'goal' => $project->goal,
                    'role' => $project->role,
                    'features' => $project->featureList(),
                    'tech' => $project->techList(),
                    'image' => $image,
                    'live' => $project->live_link,
                    'github' => $project->github_link,
                    'detail' => route('projects.show', $project),
                ];
            @endphp
            <article class="project-card animate-on-scroll group rounded-[2rem] overflow-hidden flex flex-col border transition-all duration-500 hover:-translate-y-2 dark:bg-zinc-900 dark:border-zinc-800 dark:hover:border-zinc-700 bg-white border-zinc-200 hover:shadow-2xl hover:shadow-emerald-500/10"
                data-search="{{ $project->title.' '.$project->description.' '.$project->tech_stack.' '.$project->category }}"
                data-tech="{{ implode(' | ', $project->techList()) }}">
                <div class="h-56 overflow-hidden relative">
                    @if($image)
                    <img src="{{ $image }}" alt="Screenshot {{ $project->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                    @else
                    <div class="w-full h-full flex items-center justify-center dark:bg-zinc-800 bg-zinc-100 text-zinc-400 font-bold">Tanpa Gambar</div>
                    @endif

                    <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-zinc-950/60 to-transparent"></div>

                    @if($project->category)
                    <span class="absolute top-4 left-4 px-3 py-1.5 rounded-full text-[10px] uppercase tracking-widest font-bold bg-white/90 text-zinc-900 backdrop-blur">
                        {{ $project->category }}
                    </span>
                    @endif

                    @if($project->is_featured)
                    <span class="absolute top-4 right-4 w-8 h-8 rounded-full bg-emerald-500 text-zinc-950 flex items-center justify-center shadow-lg" title="Proyek unggulan">
                        <i class="fas fa-star text-xs"></i>
                    </span>
                    @endif
                </div>

                <div class="p-6 md:p-7 flex-1 flex flex-col">
                    <h3 class="text-2xl font-extrabold mb-2 group-hover:text-emerald-500 transition-colors">{{ $project->title }}</h3>
                    <p class="text-sm leading-relaxed dark:text-zinc-400 text-zinc-600 mb-5 flex-1">{{ $project->description }}</p>

                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($project->techList() as $tech)
                        <span class="text-[10px] uppercase tracking-wider font-bold px-2.5 py-1 rounded-md dark:bg-zinc-800 dark:text-zinc-300 bg-zinc-100 text-zinc-600">{{ $tech }}</span>
                        @endforeach
                    </div>

                    <div class="mt-auto pt-5 border-t dark:border-zinc-800 border-zinc-200 flex flex-wrap items-center gap-2">
                        <button type="button" onclick="openProjectPreview(this)" data-project='@json($payload)'
                            class="px-4 py-2 rounded-full text-xs font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 transition-colors">
                            <i class="fas fa-eye mr-1"></i> Preview
                        </button>
                        <a href="{{ route('projects.show', $project) }}" class="px-4 py-2 rounded-full text-xs font-bold border dark:border-zinc-700 border-zinc-300 dark:text-zinc-200 text-zinc-700 hover:border-emerald-500 hover:text-emerald-500 transition-colors">
                            Detail
                        </a>
                        <div class="ml-auto flex items-center gap-1">
                            @if($project->live_link)
                            <a href="{{ $project->live_link }}" target="_blank" rel="noopener" title="Lihat demo"
                                class="w-9 h-9 rounded-full flex items-center justify-center dark:text-zinc-400 text-zinc-500 hover:text-emerald-500 hover:bg-emerald-500/10 transition-colors">
                                <i class="fas fa-arrow-up-right-from-square text-xs"></i>
                            </a>
                            @endif
                            @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" rel="noopener" title="Source code GitHub"
                                class="w-9 h-9 rounded-full flex items-center justify-center dark:text-zinc-400 text-zinc-500 hover:text-emerald-500 hover:bg-emerald-500/10 transition-colors">
                                <i class="fab fa-github"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-24 rounded-[2rem] border-2 border-dashed dark:border-zinc-800 dark:text-zinc-600 border-zinc-300 text-zinc-400">
                <i class="fas fa-folder-open text-4xl mb-4 opacity-60"></i>
                <p class="text-lg font-medium">Belum ada proyek yang ditambahkan.</p>
            </div>
            @endforelse
        </div>

        <div id="projectEmpty" class="{{ $projects->isEmpty() ? '' : 'hidden' }} text-center py-20 mt-6 rounded-[2rem] border-2 border-dashed dark:border-zinc-800 dark:text-zinc-600 border-zinc-300 text-zinc-400">
            <i class="fas fa-magnifying-glass text-3xl mb-3 opacity-60"></i>
            <p class="font-semibold">Tidak ada proyek yang cocok dengan pencarian.</p>
            <p class="text-sm mt-1">Coba kata kunci lain atau pilih filter "Semua".</p>
        </div>
    </div>
</section>
