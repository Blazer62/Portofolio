@extends('layouts.admin')

@section('title', 'Profil')
@section('header', 'Informasi Profil')
@section('subheader', 'Ubah nama, branding, kontak, foto, dan narasi tanpa menyentuh kode.')

@php
    $input = 'w-full px-3.5 py-2.5 rounded-xl border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20';
    $label = 'block text-xs font-bold uppercase tracking-wide text-zinc-500 dark:text-zinc-400 mb-1.5';
    $photo = \App\Support\Media::url($profile->photo ?? null);
    $cvFile = \App\Support\Media::url($profile->cv_file ?? null);
@endphp

@section('content')
<form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 md:p-6">
        <h2 class="font-extrabold mb-4">Identitas &amp; Branding</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="{{ $label }}">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $profile->name ?? '') }}" required class="{{ $input }}">
            </div>
            <div>
                <label class="{{ $label }}">Headline / Peran</label>
                <input type="text" name="headline" value="{{ old('headline', $profile->headline ?? 'Frontend Developer') }}" required class="{{ $input }}" placeholder="Frontend Developer">
            </div>
            <div class="md:col-span-2">
                <label class="{{ $label }}">Tagline Singkat</label>
                <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline ?? '') }}" class="{{ $input }}" placeholder="Membangun antarmuka web yang rapi dan responsif.">
            </div>
            <div class="md:col-span-2">
                <label class="{{ $label }}">Bio / Personal Branding</label>
                <textarea name="bio" rows="4" class="{{ $input }}">{{ old('bio', $profile->bio ?? '') }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="{{ $label }}">Ringkasan untuk CV (2–3 baris)</label>
                <textarea name="cv_summary" rows="3" class="{{ $input }}" placeholder="Siswa kelas XII PPLG SMKN 2 Banjarmasin yang fokus pada pengembangan antarmuka web...">{{ old('cv_summary', $profile->cv_summary ?? '') }}</textarea>
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1">Dipakai di bagian Ringkasan halaman CV. Kosongkan untuk memakai Bio.</p>
            </div>
        </div>
    </div>

    <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 md:p-6">
        <h2 class="font-extrabold mb-4">Akademik</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="{{ $label }}">Kelas</label>
                <input type="text" name="class" value="{{ old('class', $profile->class ?? '') }}" class="{{ $input }}" placeholder="XII">
            </div>
            <div>
                <label class="{{ $label }}">Kompetensi Keahlian</label>
                <input type="text" name="major" value="{{ old('major', $profile->major ?? '') }}" class="{{ $input }}" placeholder="Pengembangan Perangkat Lunak dan Gim (PPLG)">
            </div>
            <div>
                <label class="{{ $label }}">Sekolah</label>
                <input type="text" name="school" value="{{ old('school', $profile->school ?? '') }}" class="{{ $input }}" placeholder="SMKN 2 Banjarmasin">
            </div>
            <div>
                <label class="{{ $label }}">Domisili</label>
                <input type="text" name="location" value="{{ old('location', $profile->location ?? '') }}" class="{{ $input }}" placeholder="Kalimantan Selatan, Indonesia">
            </div>
        </div>
    </div>

    <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 md:p-6">
        <h2 class="font-extrabold mb-4">Kontak &amp; Media Sosial</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="{{ $label }}">Email</label>
                <input type="email" name="email" value="{{ old('email', $profile->email ?? '') }}" class="{{ $input }}">
            </div>
            <div>
                <label class="{{ $label }}">GitHub (URL)</label>
                <input type="text" name="github" value="{{ old('github', $profile->github ?? '') }}" class="{{ $input }}" placeholder="https://github.com/username">
            </div>
            <div>
                <label class="{{ $label }}">Instagram (URL)</label>
                <input type="text" name="instagram" value="{{ old('instagram', $profile->instagram ?? '') }}" class="{{ $input }}" placeholder="https://instagram.com/username">
            </div>
            <div>
                <label class="{{ $label }}">WhatsApp (URL)</label>
                <input type="text" name="whatsapp" value="{{ old('whatsapp', $profile->whatsapp ?? '') }}" class="{{ $input }}" placeholder="https://wa.me/628xxxxxxxxxx">
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1">Nomor ini tampil di bagian Kontak dan CV setelah email.</p>
            </div>
        </div>
    </div>

    <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 md:p-6">
        <h2 class="font-extrabold mb-4">Foto &amp; CV</h2>
        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="{{ $label }}">Foto Profil</label>
                <div class="flex items-center gap-3 mb-2">
                    @if($photo)
                    <img src="{{ $photo }}" alt="" class="w-16 h-16 rounded-xl object-cover border border-zinc-200 dark:border-zinc-800">
                    @else
                    <span class="w-16 h-16 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-400 dark:text-zinc-500"><i class="fas fa-user"></i></span>
                    @endif
                    <input type="file" name="photo_file" accept="image/*" class="text-sm file:mr-3 file:px-3 file:py-2 file:rounded-lg file:border-0 file:bg-emerald-500 file:text-zinc-950 file:text-xs file:font-bold">
                </div>
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Disarankan foto formal dengan rasio 4:5.</p>
            </div>
            <div>
                <label class="{{ $label }}">File CV (PDF)</label>
                @if($cvFile)
                <p class="text-xs mb-2"><a href="{{ $cvFile }}" target="_blank" class="text-emerald-600 dark:text-emerald-400 font-bold"><i class="fas fa-file-pdf mr-1"></i>Lihat CV saat ini</a></p>
                @endif
                <input type="file" name="cv_file" accept=".pdf" class="text-sm file:mr-3 file:px-3 file:py-2 file:rounded-lg file:border-0 file:bg-zinc-800 file:text-white file:text-xs file:font-bold">
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1">Kosongkan jika belum ada. Halaman CV digital tetap bisa dicetak.</p>
            </div>
        </div>
    </div>

    <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 md:p-6">
        <h2 class="font-extrabold mb-4">Narasi Tambahan</h2>
        <div class="grid gap-4">
            <div>
                <label class="{{ $label }}">Minat &amp; Bidang Teknologi (satu per baris)</label>
                <textarea name="interests" rows="5" class="{{ $input }}" placeholder="UI/UX Design&#10;Frontend Development">{{ old('interests', $profile->interests ?? '') }}</textarea>
            </div>
            <div>
                <label class="{{ $label }}">Bahasa (satu per baris)</label>
                <textarea name="languages" rows="3" class="{{ $input }}" placeholder="Indonesia (Aktif)&#10;Inggris (Pasif)">{{ old('languages', $profile->languages ?? '') }}</textarea>
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1">Tampil di halaman CV. Contoh: Indonesia (Aktif).</p>
            </div>
            <div>
                <label class="{{ $label }}">Cita-cita / Tujuan Karir</label>
                <textarea name="career_goal" rows="4" class="{{ $input }}">{{ old('career_goal', $profile->career_goal ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap gap-2">
        <button type="submit" class="px-6 py-3 rounded-xl text-sm font-bold bg-emerald-500 text-zinc-950 hover:bg-emerald-600 transition-colors">
            <i class="fas fa-floppy-disk mr-1"></i> Simpan Profil
        </button>
        <a href="{{ route('home') }}" target="_blank" class="px-6 py-3 rounded-xl text-sm font-bold border border-zinc-300 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
            <i class="fas fa-eye mr-1"></i> Lihat Hasil
        </a>
    </div>
</form>
@endsection
