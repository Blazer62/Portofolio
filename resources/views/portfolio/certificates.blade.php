@php
    $total = $certificates->count();
@endphp

<section id="certificates" class="py-24 px-6 relative">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-wrap justify-between items-end gap-4 mb-12 animate-on-scroll">
            <div>
                <span class="section-kicker mb-4">Sertifikat</span>
                <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight">Bukti Perjalanan Belajar</h2>
            </div>
            <span class="px-4 py-2 rounded-full text-xs font-bold border dark:border-zinc-800 border-zinc-200 dark:text-zinc-300 text-zinc-600">{{ $total }} dokumen</span>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($certificates as $certificate)
            @php $image = \App\Support\Media::url($certificate->image); @endphp
            <article class="animate-on-scroll group rounded-[1.75rem] overflow-hidden border dark:bg-zinc-900 dark:border-zinc-800 bg-white border-zinc-200 transition-all duration-500 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-emerald-500/10 flex flex-col">
                <div class="relative h-44 overflow-hidden dark:bg-zinc-950 bg-zinc-100">
                    @if($image)
                    <img src="{{ $image }}" alt="{{ $certificate->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                    <button type="button" onclick="openLightbox('{{ $image }}')" class="absolute inset-0 bg-zinc-950/0 group-hover:bg-zinc-950/30 transition-colors flex items-center justify-center">
                        <span class="opacity-0 group-hover:opacity-100 transition-opacity px-4 py-2 rounded-full bg-white text-zinc-900 text-xs font-bold">Lihat dokumen</span>
                    </button>
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-emerald-500/15 to-emerald-500/5">
                        <i class="fas fa-award text-5xl text-emerald-500/60"></i>
                    </div>
                    @endif

                    @if($certificate->year)
                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-[10px] font-bold bg-zinc-950/80 text-white backdrop-blur">{{ $certificate->year }}</span>
                    @endif
                </div>

                <div class="p-5 flex-1 flex flex-col">
                    <h3 class="font-extrabold leading-snug mb-1 group-hover:text-emerald-500 transition-colors">{{ $certificate->title }}</h3>
                    @if($certificate->issuer)
                    <p class="text-xs font-semibold text-emerald-500 mb-3">{{ $certificate->issuer }}</p>
                    @endif
                    @if($certificate->description)
                    <p class="text-sm leading-relaxed dark:text-zinc-400 text-zinc-600 flex-1">{{ $certificate->description }}</p>
                    @endif

                    @if($certificate->file)
                    <a href="{{ \App\Support\Media::url($certificate->file) }}" target="_blank" rel="noopener"
                        class="mt-4 inline-flex items-center gap-2 text-xs font-bold text-emerald-500 hover:text-emerald-600 transition-colors">
                        <i class="fas fa-file-lines"></i> Dokumentasi
                    </a>
                    @endif
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-20 rounded-[2rem] border-2 border-dashed dark:border-zinc-800 dark:text-zinc-600 border-zinc-300 text-zinc-400">
                <i class="fas fa-award text-4xl mb-3 opacity-60"></i>
                <p class="font-semibold">Belum ada sertifikat.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
