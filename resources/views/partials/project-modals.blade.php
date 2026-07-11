<div id="addModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-zinc-950/80 backdrop-blur-sm overflow-y-auto">
    <div class="w-full max-w-lg rounded-[2rem] shadow-2xl p-8 relative border dark:bg-zinc-900 dark:border-zinc-800 bg-white border-zinc-200">
        <button onclick="closeModal('addModal')" class=" absolute top-6 right-6 p-2 rounded-full transition-colors dark:hover:bg-zinc-800 hover:bg-zinc-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <h2 id="modalTitle" class="text-2xl font-bold mb-6">Project Baru</h2>

        <form id="projectForm" method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <input type="hidden" name="id" id="projectId" value="">
            <input type="hidden" id="formMethod" value="POST">

            <div>
                <label class="block text-sm font-semibold mb-2">Judul Project</label>
                <input type="text" name="title" id="projectTitle" required
                    class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-emerald-500 outline-none transition-all dark:bg-zinc-950 dark:border-zinc-800 bg-zinc-50 border-zinc-300"
                    placeholder="Contoh: Sistem Informasi Akademik" />
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Deskripsi</label>
                <textarea name="description" id="projectDesc" required rows="3"
                    class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-emerald-500 outline-none transition-all resize-none dark:bg-zinc-950 dark:border-zinc-800 bg-zinc-50 border-zinc-300"
                    placeholder="Jelaskan fitur utama..."></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-2">Gambar Project (Opsional)</label>
                    <input type="file" name="image" id="projectImg" accept="image/*"
                        class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-emerald-500 outline-none transition-all dark:bg-zinc-950 dark:border-zinc-800 bg-zinc-50 border-zinc-300 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-emerald-500 file:text-zinc-950 file:font-semibold file:text-sm hover:file:bg-emerald-600" />
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Live Link (Opsional)</label>
                    <input type="text" name="live_link" id="projectLink"
                        class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-emerald-500 outline-none transition-all dark:bg-zinc-950 dark:border-zinc-800 bg-zinc-50 border-zinc-300"
                        placeholder="https://..." />
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Tech Stack (Pisahkan koma)</label>
                <input type="text" name="tech_stack" id="projectTech" required
                    class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-emerald-500 outline-none transition-all dark:bg-zinc-950 dark:border-zinc-800 bg-zinc-50 border-zinc-300"
                    placeholder="PHP, MySQL, Tailwind" />
            </div>

            <div class="pt-4 flex gap-3">
                <button type="button" onclick="closeModal('addModal')" class=" flex-1 py-3 rounded-xl font-bold transition-colors dark:bg-zinc-800 dark:hover:bg-zinc-700 dark:text-white bg-zinc-200 hover:bg-zinc-300 text-zinc-900">
                    Batal
                </button>
                <button type="submit" id="submitBtn" class=" flex-1 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-zinc-950 font-bold transition-colors shadow-lg shadow-emerald-500/20">
                    Publish Project
                </button>
            </div>
        </form>
    </div>
</div>

<div id="deleteModal" class="hidden fixed inset-0 z-[110] flex items-center justify-center p-4 bg-zinc-950/80 backdrop-blur-sm">
    <div class="w-full max-w-sm rounded-[2rem] shadow-2xl p-8 text-center border dark:bg-zinc-900 dark:border-zinc-800 bg-white border-zinc-200">
        <div class="w-16 h-16 bg-red-500/10 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </div>
        <h3 class="text-xl font-bold mb-2">Hapus Project?</h3>
        <p class="mb-8 text-sm dark:text-zinc-400 text-zinc-500">Project ini akan dihapus secara permanen dari database.</p>

        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" id="deleteProjectId" value="">
            <div class="flex gap-3">
                <button type="button" onclick="closeModal('deleteModal')" class=" flex-1 py-3 rounded-xl font-bold transition-colors dark:bg-zinc-800 dark:hover:bg-zinc-700 dark:text-white bg-zinc-200 hover:bg-zinc-300 text-zinc-900">
                    Batal
                </button>
                <button type="submit" class=" flex-1 py-3 rounded-xl bg-red-500 hover:bg-red-600 text-white font-bold transition-colors">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>
