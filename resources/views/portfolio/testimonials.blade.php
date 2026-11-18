@php
    $typeLabels = \App\Models\Testimonial::TYPES;
    $allTestimonials = $testimonials instanceof \Illuminate\Support\Collection && $testimonials->first() instanceof \Illuminate\Support\Collection
        ? $testimonials->flatten(1)
        : $testimonials;
    $totalTestimonials = $allTestimonials->count();
@endphp

<section id="testimonials" class="py-24 px-6 relative overflow-hidden">
    {{-- Aksen gradient latar belakang --}}
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-emerald-500/[0.02] to-transparent pointer-events-none"></div>

    <div class="max-w-6xl mx-auto relative">
        {{-- Section Header --}}
        <div class="animate-on-scroll mb-12 flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="section-kicker mb-4">Testimoni &amp; Rekomendasi</span>
                <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight">Kata Mereka</h2>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold dark:bg-zinc-900 bg-white border dark:border-zinc-800 border-zinc-200 dark:text-zinc-300 text-zinc-700 shadow-xs">
                    <i class="fas fa-comments text-emerald-500"></i>
                    {{ $totalTestimonials }} Testimoni
                </span>
            </div>
        </div>

        <div class="grid lg:grid-cols-12 gap-8 items-start">
            {{-- Kolom Kiri: Formulir Tambah Testimoni Publik (Sticky di Desktop) --}}
            <div class="lg:col-span-5 animate-on-scroll lg:sticky lg:top-24">
                <div class="rounded-[2rem] border dark:bg-zinc-900 dark:border-zinc-800 bg-white border-zinc-200 p-6 sm:p-7 shadow-sm">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center font-bold">
                            <i class="fas fa-pen-nib"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-extrabold leading-tight">Beri Testimoni</h3>
                            <p class="text-xs dark:text-zinc-400 text-zinc-500">Bagikan kesan atau pengalamanmu!</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('testimonials.store') }}" enctype="multipart/form-data" class="mt-5 space-y-4">
                        @csrf

                        {{-- Input Nama --}}
                        <div class="space-y-1.5">
                            <label for="testi_name" class="block text-xs font-bold uppercase tracking-wider text-zinc-600 dark:text-zinc-400">
                                Nama Lengkap / Panggilan <span class="text-emerald-500">*</span>
                            </label>
                            <input type="text" id="testi_name" name="name" value="{{ old('name') }}" required maxlength="255"
                                placeholder="Contoh: Budi Santoso"
                                class="w-full px-4 py-3 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-zinc-50/80 dark:bg-zinc-950/60 text-sm text-zinc-900 dark:text-zinc-100 placeholder:text-zinc-400 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                        </div>

                        {{-- Input Kategori Hubungan --}}
                        <div class="space-y-1.5">
                            <label for="testi_type" class="block text-xs font-bold uppercase tracking-wider text-zinc-600 dark:text-zinc-400">
                                Hubungan / Kategori <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="testi_type" name="type" required
                                    class="w-full px-4 py-3 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-zinc-50/80 dark:bg-zinc-950/60 text-sm text-zinc-900 dark:text-zinc-100 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all appearance-none cursor-pointer">
                                    <option value="teman" {{ old('type') === 'teman' ? 'selected' : '' }}>Teman / Rekan Tim</option>
                                    <option value="guru" {{ old('type') === 'guru' ? 'selected' : '' }}>Guru / Pembimbing</option>
                                    <option value="pengguna" {{ old('type') === 'pengguna' ? 'selected' : '' }}>Pengguna Karya / Klien</option>
                                    <option value="plk" {{ old('type') === 'plk' ? 'selected' : '' }}>Tempat / Rekan PKL</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-zinc-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Input Pesan Testimoni --}}
                        <div class="space-y-1.5">
                            <label for="testi_message" class="block text-xs font-bold uppercase tracking-wider text-zinc-600 dark:text-zinc-400">
                                Pesan Testimoni <span class="text-emerald-500">*</span>
                            </label>
                            <textarea id="testi_message" name="message" rows="4" required maxlength="1000"
                                placeholder="Tuliskan pengalaman atau kesanmu tentang karya dan cara kerja saya..."
                                class="w-full px-4 py-3 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-zinc-50/80 dark:bg-zinc-950/60 text-sm text-zinc-900 dark:text-zinc-100 placeholder:text-zinc-400 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all resize-y">{{ old('message') }}</textarea>
                        </div>

                        {{-- Input Foto Profil (Opsional) --}}
                        <div class="space-y-1.5">
                            <label for="testi_photo" class="block text-xs font-bold uppercase tracking-wider text-zinc-600 dark:text-zinc-400">
                                Foto Profil <span class="text-[10px] font-normal lowercase text-zinc-400">(opsional, maks 3MB)</span>
                            </label>
                            <input type="file" id="testi_photo" name="photo_file" accept="image/*"
                                class="w-full text-xs text-zinc-500 dark:text-zinc-400 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-emerald-500/10 file:text-emerald-600 hover:file:bg-emerald-500/20 cursor-pointer">
                        </div>

                        {{-- Tombol Kirim --}}
                        <button type="submit"
                            class="w-full mt-2 py-3.5 px-6 rounded-xl font-bold text-sm bg-emerald-500 hover:bg-emerald-600 text-zinc-950 shadow-md shadow-emerald-500/20 active:scale-98 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane text-xs"></i>
                            Kirim Testimoni
                        </button>
                    </form>
                </div>
            </div>

            {{-- Kolom Kanan: Daftar Testimoni yang Sudah Masuk --}}
            <div class="lg:col-span-7 space-y-4 animate-on-scroll" style="transition-delay: 100ms">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-extrabold text-zinc-900 dark:text-white">Daftar Testimoni</h3>
                    <span class="text-xs text-zinc-500 dark:text-zinc-400 font-semibold">{{ $totalTestimonials }} ulasan</span>
                </div>

                @forelse($allTestimonials as $testimonial)
                @php
                    $photo = \App\Support\Media::url($testimonial->photo);
                @endphp
                <figure class="rounded-[2rem] border dark:bg-zinc-900 dark:border-zinc-800 bg-white border-zinc-200 p-6 md:p-7 shadow-xs relative overflow-hidden transition-all hover:border-emerald-500/40">
                    {{-- Ikon kutipan transparan --}}
                    <i class="fas fa-quote-right absolute -top-2 right-4 text-7xl text-emerald-500/10 dark:text-emerald-500/5 pointer-events-none"></i>

                    <div class="flex flex-wrap items-center justify-between gap-2 mb-3.5 relative z-10">
                        <span class="px-2.5 py-1 rounded-full text-[10px] uppercase tracking-widest font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                            {{ $typeLabels[$testimonial->type] ?? $testimonial->type }}
                        </span>
                        @if($testimonial->created_at)
                        <span class="text-[11px] text-zinc-400 dark:text-zinc-500">
                            {{ $testimonial->created_at->diffForHumans() }}
                        </span>
                        @endif
                    </div>

                    <blockquote class="text-sm md:text-[15px] leading-relaxed dark:text-zinc-300 text-zinc-700 relative z-10">
                        &ldquo;{{ $testimonial->message }}&rdquo;
                    </blockquote>

                    <figcaption class="flex items-center gap-3.5 mt-5 pt-4 border-t dark:border-zinc-800/80 border-zinc-100">
                        @if($photo)
                        <img src="{{ $photo }}" alt="{{ $testimonial->name }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-emerald-500/30" loading="lazy">
                        @else
                        <span class="w-10 h-10 rounded-full bg-emerald-500 text-zinc-950 flex items-center justify-center font-extrabold text-sm shrink-0">
                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                        </span>
                        @endif
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-zinc-900 dark:text-white truncate">{{ $testimonial->name }}</p>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 truncate">{{ $testimonial->role ?: ($typeLabels[$testimonial->type] ?? '') }}</p>
                        </div>
                    </figcaption>
                </figure>
                @empty
                <div class="text-center py-16 rounded-[2rem] border-2 border-dashed dark:border-zinc-800 dark:text-zinc-600 border-zinc-300 text-zinc-400">
                    <i class="fas fa-comment-dots text-4xl mb-3 opacity-60"></i>
                    <p class="font-bold text-base">Belum ada testimoni.</p>
                    <p class="text-xs mt-1">Jadilah yang pertama menuliskan testimoni menggunakan form di sebelah!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
