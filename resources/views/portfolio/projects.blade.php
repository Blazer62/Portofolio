<section id="projects" class="py-24 px-6 relative">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-row flex-wrap justify-between items-center mb-12 gap-4 animate-on-scroll">
            <div>
                <h2 class="text-3xl font-bold mb-2">Project </h2>
                <p class="dark:text-zinc-400 text-zinc-500">Project dinamis yang dimuat dari database MySQL.</p>
            </div>
            @auth
            <button onclick="openModal('addModal')" class=" px-6 py-3 rounded-full font-bold transition-all flex items-center gap-2 text-sm bg-emerald-500 text-zinc-950 hover:bg-emerald-600 shadow-lg shadow-emerald-500/20 hover:scale-105 active:scale-95 shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Project
            </button>
            @endauth
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            @forelse($projects as $project)
            <div class="animate-on-scroll group rounded-[2rem] overflow-hidden flex flex-col border transition-all duration-500 hover:-translate-y-2 tilt-card dark:bg-zinc-900 dark:border-zinc-800 dark:hover:border-zinc-700 bg-white border-zinc-200 hover:shadow-2xl hover:shadow-emerald-500/10" data-tilt>
                <div class="h-64 overflow-hidden relative">
                    @if($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    @elseif($project->image_url)
                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" onerror="this.src='https://placehold.co/600x400/18181b/34d399?text=No+Image'" />
                    @else
                    <div class="w-full h-full flex items-center justify-center dark:bg-zinc-800 bg-zinc-100">Tanpa Gambar</div>
                    @endif

                    @auth
                    <div class="absolute top-4 right-4 flex gap-2 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <button onclick='openEditModal(@json($project))' class=" p-2.5 bg-white/90 backdrop-blur text-zinc-900 rounded-full hover:bg-emerald-500 hover:text-white transition-colors shadow-lg" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </button>
                        <button onclick="confirmDelete({{ $project->id }})" class=" p-2.5 bg-white/90 backdrop-blur text-red-600 rounded-full hover:bg-red-600 hover:text-white transition-colors shadow-lg" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                    @endauth
                </div>

                <div class="p-8 flex-1 flex flex-col">
                    <h3 class="text-2xl font-bold mb-3 group-hover:text-emerald-500 transition-colors">{{ $project->title }}</h3>
                    <p class="mb-6 text-sm leading-relaxed flex-1 dark:text-zinc-400 text-zinc-600">{{ $project->description }}</p>

                    <div class="mt-auto pt-6 border-t dark:border-zinc-800 border-zinc-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $project->tech_stack) as $tech)
                            @if(trim($tech) != '')
                            <span class="text-[10px] uppercase tracking-wider font-bold px-2.5 py-1 rounded-md dark:bg-zinc-800 dark:text-zinc-300 bg-zinc-100 text-zinc-600">
                                {{ trim($tech) }}
                            </span>
                            @endif
                            @endforeach
                        </div>

                        @if($project->live_link)
                        <a href="{{ $project->live_link }}" target="_blank" class=" inline-flex items-center gap-1.5 text-sm font-bold text-emerald-500 hover:text-emerald-600 transition-colors group/link shrink-0">
                            Kunjungi Web <svg class="w-4 h-4 transform group-hover/link:-rotate-45 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center py-24 rounded-[2rem] border-2 border-dashed dark:border-zinc-800 dark:text-zinc-600 border-zinc-300 text-zinc-400 animate-on-scroll">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <p class="text-lg font-medium">Belum ada project. Mulai tambahkan dari database!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
