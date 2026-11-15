<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Seed data project portofolio.
     *
     * Catatan: data ini hasil rekonstruksi. Silakan edit/tambah lewat dashboard admin.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Kalkulator Web',
                'description' => 'Aplikasi kalkulator berbasis web dengan operasi aritmatika dasar, tampilan responsif, dan logika perhitungan menggunakan JavaScript murni.',
                'image' => null,
                'image_url' => '/images/projects/kalkulator.png',
                'live_link' => 'https://github.com/Blazer62/Kalkulator',
                'tech_stack' => 'HTML, CSS, JavaScript',
            ],
            [
                'title' => 'Pustaka Kode',
                'description' => 'Website kumpulan snippet dan referensi kode program untuk belajar pemrograman, dilengkapi pencarian dan kategori materi.',
                'image' => null,
                'image_url' => '/images/projects/pustaka.png',
                'live_link' => 'https://github.com/Blazer62/pustaka-kode',
                'tech_stack' => 'HTML, CSS, JavaScript',
            ],
            [
                'title' => 'Web Pembelajaran',
                'description' => 'Media pembelajaran interaktif untuk siswa, berisi materi, kuis, dan dashboard yang responsif di berbagai perangkat.',
                'image' => null,
                'image_url' => '/images/projects/web-sekolah.png',
                'live_link' => 'https://github.com/Blazer62/web-pembelajaran',
                'tech_stack' => 'HTML, CSS, JavaScript, Bootstrap',
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(['title' => $project['title']], $project);
        }
    }
}
