@extends('layouts.app')

@section('title', 'CV | '.($siteProfile->name ?? 'Portofolio').' - '.($siteProfile->headline ?? 'Frontend Developer'))
@section('description', 'Curriculum Vitae profesional '.($siteProfile->name ?? 'Gusti Rizky Ananda').' - Frontend Developer')

@push('styles')
<style>
    /* Styling Dasar Lembar CV */
    .cv-sheet {
        width: 100%;
        max-width: 210mm;
        min-height: 297mm;
        background: #ffffff;
        display: flex;
        flex-direction: column;
        color: #18181b;
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    .cv-h {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 10.5px;
        letter-spacing: .16em;
        text-transform: uppercase;
        font-weight: 800;
        color: #059669;
        margin-bottom: 9px;
    }
    .cv-h::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e4e4e7;
    }

    /* KONTROL CETAK (PRINT & SAVE AS PDF) */
    @media print {
        @page {
            size: A4 portrait;
            margin: 0 !important;
        }

        /* 1. Hilangkan semua elemen web global yang bukan bagian lembar CV */
        nav,
        body > footer,
        #particles-canvas,
        #scrollTopBtn,
        .loading-bar,
        #success-notif,
        .no-print,
        .project-modal {
            display: none !important;
            visibility: hidden !important;
            height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* 2. Reset Body & HTML ke ukuran presisi A4 */
        html, body {
            width: 210mm !important;
            height: 297mm !important;
            max-height: 297mm !important;
            background: #ffffff !important;
            background-color: #ffffff !important;
            color: #18181b !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }

        main {
            padding: 0 !important;
            margin: 0 !important;
            width: 210mm !important;
        }

        .cv-page {
            padding: 0 !important;
            margin: 0 !important;
            width: 210mm !important;
            max-width: 210mm !important;
        }

        .cv-page > div {
            max-width: 210mm !important;
            width: 210mm !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* 3. Lembar CV pas persis 1 halaman A4 */
        .cv-sheet {
            width: 210mm !important;
            max-width: 210mm !important;
            height: 297mm !important;
            max-height: 297mm !important;
            min-height: 297mm !important;
            box-shadow: none !important;
            border: none !important;
            border-radius: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
            page-break-inside: avoid !important;
            page-break-after: avoid !important;
            background: #ffffff !important;
        }

        /* 4. Paksa tata letak tetap 2 kolom berdampingan (tidak menumpuk) */
        .cv-grid {
            display: grid !important;
            grid-template-columns: 33% 67% !important;
            flex: 1 1 auto !important;
        }

        /* 5. Paksa warna background dan border tetap tercetak */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }

        .cv-sidebar {
            background-color: #f8fafc !important;
            border-right: 1px solid #e2e8f0 !important;
        }

        .cv-header-banner {
            border-bottom: 2.5px solid #10b981 !important;
            background: #f0fdf4 !important;
            background: linear-gradient(to right, rgba(236, 253, 245, 0.7), #ffffff, #ffffff) !important;
        }
    }
</style>
@endpush

@section('content')
@php
    $photo = \App\Support\Media::url($siteProfile->photo ?? null);
    $cvFile = \App\Support\Media::url($siteProfile->cv_file ?? null);
    $waDigits = $siteProfile->whatsapp ? preg_replace('/\D+/', '', $siteProfile->whatsapp) : null;
    $waDisplay = null;

    if ($waDigits) {
        $local = str_starts_with($waDigits, '62') ? substr($waDigits, 2) : $waDigits;
        $waDisplay = '+62 '.substr($local, 0, 3).'-'.substr($local, 3, 4).'-'.substr($local, 7);
    }

    $hardSkills = $skills->get('hard', collect());
    $softSkills = $skills->get('soft', collect());
    $tools = ['Git & GitHub', 'Visual Studio Code', 'Figma (UI/UX)', 'Vercel'];

    $interests = collect(preg_split('/[\r\n,]+/', (string) $siteProfile->interests))
        ->map(fn ($item) => trim($item))
        ->filter()
        ->values();

    $languages = collect(preg_split('/[\r\n]+/', (string) $siteProfile->languages))
        ->map(fn ($item) => trim($item))
        ->filter()
        ->values();

    $summary = trim((string) ($siteProfile->cv_summary ?: $siteProfile->bio));

    $experienceGroups = [
        'plk' => 'Pengalaman Praktik Kerja / Magang',
        'organisasi' => 'Organisasi & Kepanitiaan',
        'lomba' => 'Prestasi & Lomba',
    ];

    $levelLabels = [
        'SMK' => 'Sekolah Menengah Kejuruan',
        'SMA' => 'Sekolah Menengah Atas',
        'SMP' => 'Sekolah Menengah Pertama',
        'MTs' => 'Madrasah Tsanawiyah',
    ];

    // Filter pendidikan formal untuk CV profesional (tidak menampilkan SD / MI)
    $filteredEducations = $educations->filter(function($edu) {
        $lvl = strtoupper(trim((string)$edu->level));
        return !in_array($lvl, ['MI', 'SD']);
    });
@endphp

<section class="cv-page pt-28 md:pt-32 pb-16 px-4 md:px-6">
    <div class="mx-auto" style="max-width: 210mm;">
        {{-- Action Bar (Hanya tampil di browser, disembunyikan saat print) --}}
        <div class="no-print flex flex-wrap items-center justify-between gap-3 mb-5">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold dark:text-zinc-400 text-zinc-500 hover:text-emerald-500 transition-colors">
                <i class="fas fa-arrow-left text-xs"></i> Kembali ke beranda
            </a>
            <div class="flex flex-wrap items-center gap-2">
                <button type="button" onclick="window.print()" class="px-5 py-2.5 rounded-full text-sm font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 shadow-md shadow-emerald-500/20 transition-all flex items-center gap-2">
                    <i class="fas fa-print"></i> Cetak / Simpan PDF
                </button>
                @if($cvFile)
                <a href="{{ $cvFile }}" download class="px-5 py-2.5 rounded-full text-sm font-bold border dark:border-zinc-700 border-zinc-300 dark:text-zinc-200 text-zinc-700 hover:border-emerald-500 hover:text-emerald-500 transition-colors flex items-center gap-2">
                    <i class="fas fa-download"></i> Unduh File CV
                </a>
                @endif
            </div>
        </div>

        {{-- Lembar CV Utama (Format Standar A4: 210mm x 297mm) --}}
        <article class="cv-sheet text-zinc-900 shadow-2xl rounded-2xl md:rounded-none overflow-hidden border border-zinc-200">
            {{-- Header Profil --}}
            <header class="cv-header-banner px-8 pt-6 pb-5 border-b-2 border-emerald-500 bg-gradient-to-r from-emerald-50/40 via-white to-white">
                <div class="flex items-center justify-between gap-5">
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-2.5">
                            <h1 class="text-[26px] md:text-[30px] font-black uppercase tracking-tight text-zinc-900 leading-tight">
                                {{ $siteProfile->name }}
                            </h1>
                        </div>

                        <p class="mt-1 text-[11.5px] md:text-[12.5px] font-bold uppercase tracking-[0.16em] text-emerald-600">
                            {{ $siteProfile->headline }}
                        </p>

                        @if($siteProfile->tagline)
                        <p class="mt-1.5 text-[11.5px] text-zinc-600 leading-relaxed max-w-[130mm]">
                            {{ $siteProfile->tagline }}
                        </p>
                        @endif
                    </div>

                    @if($photo)
                    <img src="{{ $photo }}" alt="{{ $siteProfile->name }}" class="w-[27mm] h-[34mm] shrink-0 object-cover object-top rounded-xl border-2 border-emerald-500/40 shadow-sm">
                    @else
                    <div class="w-[27mm] h-[34mm] shrink-0 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-3xl font-extrabold border-2 border-emerald-500/40">
                        {{ strtoupper(substr($siteProfile->name ?? 'P', 0, 1)) }}
                    </div>
                    @endif
                </div>
            </header>

            {{-- Body 2 Kolom --}}
            <div class="cv-grid grid md:grid-cols-[33%_1fr] flex-1">
                {{-- Kolom Kiri (Sidebar Info, Kontak, Skill, Tools) --}}
                <aside class="cv-sidebar bg-zinc-50 border-r border-zinc-200 px-6 py-5 space-y-4">
                    {{-- Kontak & Tautan Profesional --}}
                    <section>
                        <h2 class="cv-h">Kontak</h2>
                        <ul class="space-y-2 text-[10.5px] text-zinc-700">
                            @if($siteProfile->location)
                            <li class="flex items-start gap-2">
                                <i class="fas fa-location-dot text-emerald-600 mt-[2px] w-3.5 text-center shrink-0"></i>
                                <span class="leading-snug">{{ $siteProfile->location }}</span>
                            </li>
                            @endif
                            @if($siteProfile->email)
                            <li class="flex items-start gap-2">
                                <i class="fas fa-envelope text-emerald-600 mt-[2px] w-3.5 text-center shrink-0"></i>
                                <a href="mailto:{{ $siteProfile->email }}" class="leading-snug break-all hover:text-emerald-600 transition-colors">{{ $siteProfile->email }}</a>
                            </li>
                            @endif
                            @if($waDisplay)
                            <li class="flex items-start gap-2">
                                <i class="fab fa-whatsapp text-emerald-600 mt-[2px] w-3.5 text-center shrink-0"></i>
                                <a href="{{ $siteProfile->whatsapp }}" target="_blank" rel="noopener" class="leading-snug hover:text-emerald-600 transition-colors">{{ $waDisplay }}</a>
                            </li>
                            @endif
                            @if($siteProfile->github)
                            <li class="flex items-start gap-2">
                                <i class="fab fa-github text-emerald-600 mt-[2px] w-3.5 text-center shrink-0"></i>
                                <a href="{{ $siteProfile->github }}" target="_blank" rel="noopener" class="leading-snug break-all hover:text-emerald-600 transition-colors">{{ preg_replace('#^https?://(www\.)?#', '', rtrim($siteProfile->github, '/')) }}</a>
                            </li>
                            @endif
                        </ul>
                    </section>

                    {{-- Keahlian Teknis (Tech Stack Standar Industri tanpa Persentase Angka) --}}
                    @if($hardSkills->isNotEmpty())
                    <section>
                        <h2 class="cv-h">Tech Stack</h2>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($hardSkills as $skill)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-white border border-zinc-200/90 text-zinc-800 text-[10px] font-semibold shadow-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                {{ $skill->name }}
                            </span>
                            @endforeach
                        </div>
                    </section>
                    @endif

                    {{-- Tools & Lingkungan Kerja --}}
                    <section>
                        <h2 class="cv-h">Tools &amp; Workflow</h2>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($tools as $tool)
                            <span class="px-2 py-0.5 rounded-md bg-zinc-200/60 text-zinc-700 text-[9.5px] font-semibold">
                                {{ $tool }}
                            </span>
                            @endforeach
                        </div>
                    </section>

                    {{-- Soft Skills --}}
                    @if($softSkills->isNotEmpty())
                    <section>
                        <h2 class="cv-h">Soft Skill</h2>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($softSkills as $skill)
                            <span class="px-2 py-0.5 rounded-md bg-emerald-50 border border-emerald-500/25 text-[9.5px] font-bold text-emerald-800">
                                {{ $skill->name }}
                            </span>
                            @endforeach
                        </div>
                    </section>
                    @endif

                    {{-- Bahasa --}}
                    @if($languages->isNotEmpty())
                    <section>
                        <h2 class="cv-h">Bahasa</h2>
                        <ul class="space-y-1.5 text-[10.5px] text-zinc-700">
                            @foreach($languages as $language)
                            <li class="flex items-start gap-2">
                                <i class="fas fa-language text-emerald-600 mt-[2px] w-3 text-center shrink-0"></i>
                                <span class="leading-snug">{{ $language }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </section>
                    @endif

                    {{-- Minat / Area Fokus --}}
                    @if($interests->isNotEmpty())
                    <section>
                        <h2 class="cv-h">Fokus &amp; Minat</h2>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($interests as $interest)
                            <span class="px-2 py-0.5 rounded-md bg-white border border-zinc-200 text-[9.5px] font-medium text-zinc-600">
                                {{ $interest }}
                            </span>
                            @endforeach
                        </div>
                    </section>
                    @endif
                </aside>

                {{-- Kolom Kanan (Konten Utama: Ringkasan, Pengalaman Kerja/PKL, Pendidikan, Sertifikat) --}}
                <div class="px-7 py-5 space-y-4">
                    {{-- Ringkasan Profesional --}}
                    @if($summary !== '')
                    <section>
                        <h2 class="cv-h">Ringkasan Profesional</h2>
                        <p class="text-[11.5px] leading-relaxed text-zinc-700 text-justify">
                            {{ $summary }}
                        </p>
                    </section>
                    @endif

                    {{-- Riwayat Pengalaman Kerja / PKL Formal --}}
                    @php
                        $hasExperience = collect($experienceGroups)->keys()->contains(fn ($type) => $experiences->get($type, collect())->isNotEmpty());
                    @endphp
                    @if($hasExperience)
                    <section>
                        <h2 class="cv-h">Pengalaman Kerja &amp; Praktik</h2>
                        <div class="space-y-3.5">
                            @foreach($experienceGroups as $type => $label)
                                @foreach($experiences->get($type, collect()) as $item)
                                @php
                                    $descLines = collect(preg_split('/\r\n|\r|\n/', (string) $item->description))
                                        ->map(fn($line) => trim($line))
                                        ->filter();
                                    $isBulletList = $descLines->isNotEmpty() && $descLines->contains(fn($l) => str_starts_with($l, '-') || str_starts_with($l, '•'));
                                @endphp
                                <div class="relative pl-3.5 border-l-2 border-emerald-500/30 pb-0.5">
                                    <span class="absolute -left-[5px] top-[4px] w-2 h-2 rounded-full bg-emerald-500 ring-4 ring-emerald-50"></span>
                                    <div class="flex flex-wrap items-baseline justify-between gap-x-3 gap-y-0.5">
                                        <h3 class="text-[12.5px] font-extrabold leading-snug text-zinc-900">{{ $item->title }}</h3>
                                        @if($item->period)
                                        <span class="text-[9.5px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200/60">{{ $item->period }}</span>
                                        @endif
                                    </div>
                                    @if($item->organization)
                                    <p class="text-[11px] font-bold text-zinc-700 mt-0.5">{{ $item->organization }}</p>
                                    @endif

                                    @if($isBulletList)
                                    <ul class="mt-1.5 space-y-1 text-[10.5px] leading-relaxed text-zinc-600">
                                        @foreach($descLines as $line)
                                        <li class="flex items-start gap-2">
                                            <span class="text-emerald-500 font-bold shrink-0 mt-[1px]">•</span>
                                            <span>{{ ltrim($line, "-• \t") }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @elseif($item->description)
                                    <p class="text-[10.5px] leading-relaxed text-zinc-600 mt-1">{{ $item->description }}</p>
                                    @endif
                                </div>
                                @endforeach
                            @endforeach
                        </div>
                    </section>
                    @endif

                    {{-- Riwayat Pendidikan Formal --}}
                    @if($filteredEducations->isNotEmpty())
                    <section>
                        <h2 class="cv-h">Pendidikan Formal</h2>
                        <div class="space-y-3">
                            @foreach($filteredEducations as $education)
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="text-[12px] font-extrabold leading-snug text-zinc-900">{{ $education->institution }}</p>
                                    <p class="text-[10.5px] font-semibold text-emerald-600 leading-snug mt-0.5">
                                        {{ $education->major ?: ($levelLabels[$education->level] ?? $education->level) }}
                                    </p>
                                    @if($education->description)
                                    <p class="text-[10px] text-zinc-500 leading-relaxed mt-0.5">
                                        {{ $education->description }}
                                    </p>
                                    @endif
                                </div>
                                <span class="text-[9.5px] font-bold text-zinc-400 whitespace-nowrap bg-zinc-100 px-2 py-0.5 rounded">
                                    {{ $education->start_year }} – {{ $education->end_year }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    @endif

                    {{-- Sertifikasi & Penghargaan --}}
                    @if($certificates->isNotEmpty())
                    <section>
                        <h2 class="cv-h">Sertifikasi &amp; Pelatihan</h2>
                        <ul class="space-y-2.5">
                            @foreach($certificates as $certificate)
                            <li class="flex items-start gap-2">
                                <div class="w-4 h-4 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5 text-[9px]">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-baseline justify-between gap-x-2">
                                        <p class="text-[11px] font-bold text-zinc-900 leading-snug">{{ $certificate->title }}</p>
                                        @if($certificate->year)
                                        <span class="text-[9.5px] font-bold text-zinc-400">{{ $certificate->year }}</span>
                                        @endif
                                    </div>
                                    <p class="text-[10px] font-semibold text-emerald-700 leading-snug mt-0.5">{{ $certificate->issuer }}</p>
                                    @if($certificate->description)
                                    <p class="text-[10px] text-zinc-500 leading-relaxed mt-0.5">{{ $certificate->description }}</p>
                                    @endif
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </section>
                    @endif
                </div>
            </div>

            {{-- Footer CV --}}
            <footer class="px-8 py-2.5 border-t border-zinc-200 flex flex-wrap items-center justify-between gap-2 text-[9px] text-zinc-400 bg-white">
                <span>CV Resmi {{ $siteProfile->name }} &bull; {{ $siteProfile->headline }}</span>
                <span>Terakhir diperbarui: {{ now()->locale('id')->translatedFormat('F Y') }}</span>
            </footer>
        </article>
    </div>
</section>
@endsection
