<div id="previewModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-zinc-950/80 backdrop-blur-sm" style="display: none;" onclick="if (event.target === this) closeModal('previewModal')">
    <div class="preview-scroll w-full max-w-3xl rounded-[2rem] shadow-2xl border dark:bg-zinc-900 dark:border-zinc-800 bg-white border-zinc-200">
        <div class="relative">
            <img id="previewImage" src="" alt="" class="hidden w-full h-64 md:h-80 object-cover rounded-t-[2rem]">
            <button onclick="closeModal('previewModal')" aria-label="Tutup"
                class="absolute top-4 right-4 w-10 h-10 rounded-full bg-zinc-950/70 text-white flex items-center justify-center hover:bg-red-500 transition-colors backdrop-blur">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div class="p-6 md:p-8">
            <span id="previewCategory" class="hidden inline-block text-[11px] uppercase tracking-widest font-bold text-emerald-500 mb-2"></span>
            <h2 id="previewTitle" class="text-2xl md:text-3xl font-extrabold tracking-tight mb-3"></h2>
            <p id="previewDescription" class="text-sm md:text-base leading-relaxed dark:text-zinc-400 text-zinc-600 mb-6"></p>

            <div class="grid sm:grid-cols-3 gap-4 mb-6">
                <div class="rounded-2xl border dark:border-zinc-800 border-zinc-200 p-4">
                    <h4 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-2">Masalah</h4>
                    <p id="previewProblem" class="text-sm leading-relaxed dark:text-zinc-400 text-zinc-600"></p>
                </div>
                <div class="rounded-2xl border dark:border-zinc-800 border-zinc-200 p-4">
                    <h4 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-2">Tujuan</h4>
                    <p id="previewGoal" class="text-sm leading-relaxed dark:text-zinc-400 text-zinc-600"></p>
                </div>
                <div class="rounded-2xl border dark:border-zinc-800 border-zinc-200 p-4">
                    <h4 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-2">Peran</h4>
                    <p id="previewRole" class="text-sm leading-relaxed dark:text-zinc-400 text-zinc-600"></p>
                </div>
            </div>

            <div class="mb-6">
                <h4 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-3">Fitur Utama</h4>
                <ul id="previewFeatures" class="grid sm:grid-cols-2 gap-2 text-sm dark:text-zinc-300 text-zinc-700"></ul>
            </div>

            <div class="mb-8">
                <h4 class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-3">Teknologi</h4>
                <div id="previewTech" class="flex flex-wrap gap-2"></div>
            </div>

            <div class="flex flex-wrap gap-3 pt-6 border-t dark:border-zinc-800 border-zinc-200">
                <a id="previewDetail" href="#" class="px-5 py-2.5 rounded-full text-sm font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 transition-colors">Detail Proyek</a>
                <a id="previewLive" href="#" target="_blank" rel="noopener" class="px-5 py-2.5 rounded-full text-sm font-bold border dark:border-zinc-700 border-zinc-300 dark:text-zinc-200 text-zinc-700 hover:border-emerald-500 hover:text-emerald-500 transition-colors">Lihat Demo</a>
                <a id="previewGithub" href="#" target="_blank" rel="noopener" class="px-5 py-2.5 rounded-full text-sm font-bold border dark:border-zinc-700 border-zinc-300 dark:text-zinc-200 text-zinc-700 hover:border-emerald-500 hover:text-emerald-500 transition-colors">Source Code</a>
                <button onclick="closeModal('previewModal')" class="ml-auto px-5 py-2.5 rounded-full text-sm font-bold dark:bg-zinc-800 dark:text-zinc-200 bg-zinc-100 text-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="lightbox" class="hidden fixed inset-0 z-[110] flex items-center justify-center p-4 bg-zinc-950/90 backdrop-blur-sm" style="display: none;" onclick="if (event.target === this) closeModal('lightbox')">
    <button onclick="closeModal('lightbox')" aria-label="Tutup" class="absolute top-6 right-6 w-11 h-11 rounded-full bg-white/10 text-white flex items-center justify-center hover:bg-red-500 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
    <img id="lightboxImage" src="" alt="Dokumentasi" class="max-h-[85vh] max-w-full rounded-2xl shadow-2xl">
</div>
