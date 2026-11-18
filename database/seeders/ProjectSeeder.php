<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Kalkulator Web',
                'category' => 'Web App',
                'description' => 'Kalkulator berbasis web dengan operasi aritmatika dasar, riwayat perhitungan, dan tampilan responsif. Dibangun dengan JavaScript murni tanpa library.',
                'problem' => 'Saat mengerjakan tugas, saya sering membuka kalkulator bawaan HP yang tampilannya kecil dan tidak nyaman untuk perhitungan panjang. Saya ingin kalkulator ringan yang bisa dibuka langsung dari browser.',
                'goal' => 'Membuat kalkulator yang cepat dimuat, mudah dipakai di HP maupun laptop, dan punya tampilan yang jelas agar tidak salah tekan tombol.',
                'role' => 'Frontend Developer (solo)',
                'features' => "Operasi aritmatika dasar (+, -, ×, ÷)\nRiwayat perhitungan terakhir\nDukungan input keyboard\nTombol hapus dan reset\nTampilan responsif untuk HP dan desktop",
                'image_url' => '/images/projects/kalkulator.png',
                'live_link' => 'https://kalkulator-kappa-azure.vercel.app/',
                'github_link' => 'https://github.com/Blazer62/Kalkulator',
                'tech_stack' => 'HTML, CSS, JavaScript',
                'documentation' => "Proses dimulai dengan membuat mockup sederhana di kertas untuk menentukan posisi tombol dan layar hasil.\n\nStruktur HTML dibuat dengan grid tombol agar mudah diatur. Logika perhitungan dipisahkan dari manipulasi tampilan supaya lebih mudah diuji.\n\nSetelah fitur dasar berjalan, saya menambahkan dukungan keyboard dan riwayat perhitungan. Tahap terakhir adalah pengujian di lebar layar 360px, 768px, dan desktop, lalu memperbaiki jarak antar tombol.\n\nKendala terbesar adalah menangani input desimal dan pembagian dengan nol. Saya menambahkan validasi sederhana sebelum hasil ditampilkan.",
                'feedback' => 'Teman sekelas menilai tombolnya besar dan nyaman dipakai di HP. Masukan yang paling sering muncul adalah agar riwayat bisa dihapus satu per satu, dan itu sudah ditambahkan.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Pustaka Kode',
                'category' => 'Website Referensi',
                'description' => 'Website kumpulan snippet dan referensi kode untuk belajar pemrograman, dilengkapi pencarian, kategori, dan tampilan kode yang mudah dibaca.',
                'problem' => 'Catatan kode saya tersebar di banyak tempat sehingga sulit ditemukan saat dibutuhkan. Saya butuh satu tempat untuk menyimpan dan mencari snippet.',
                'goal' => 'Menyediakan pustaka kode pribadi yang cepat diakses, mudah dicari, dan nyaman dibaca di berbagai perangkat.',
                'role' => 'Frontend Developer (solo)',
                'features' => "Pencarian snippet berdasarkan judul dan kata kunci\nKategori bahasa pemrograman\nTampilan kode dengan penomoran baris\nTombol salin kode\nDesain responsif",
                'image_url' => '/images/projects/pustaka.png',
                'live_link' => 'https://pustaka-kode.vercel.app/',
                'github_link' => 'https://github.com/Blazer62/pustaka-kode',
                'tech_stack' => 'HTML, CSS, JavaScript',
                'documentation' => "Saya mulai dengan mengumpulkan snippet yang paling sering dipakai, lalu menyusunnya dalam struktur data JavaScript.\n\nTampilan daftar dibuat menggunakan kartu agar mudah dipindai. Fitur pencarian bekerja dengan memfilter data berdasarkan judul, kategori, dan isi kode.\n\nSetelah fungsi utama selesai, saya menambahkan tombol salin dan memperbaiki keterbacaan kode di layar kecil dengan scroll horizontal.\n\nPengujian dilakukan dengan mencoba berbagai kata kunci dan memastikan hasil pencarian tetap muncul saat kategori diganti.",
                'feedback' => 'Pengguna merasa pencariannya cepat dan tampilan kode mudah dibaca. Beberapa meminta fitur filter berdasarkan bahasa, yang kemudian saya tambahkan.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Web Pembelajaran',
                'category' => 'Media Pembelajaran',
                'description' => 'Media pembelajaran interaktif untuk siswa, berisi materi, kuis, dan dashboard yang responsif. Dirancang agar guru bisa menyampaikan materi dengan lebih menarik.',
                'problem' => 'Materi pembelajaran masih disampaikan lewat slide yang monoton, sehingga siswa cepat bosan dan sulit mengulang materi secara mandiri.',
                'goal' => 'Membuat media pembelajaran yang interaktif, mudah diakses dari HP, dan bisa dipakai guru untuk mengulang materi serta mengukur pemahaman siswa melalui kuis.',
                'role' => 'Frontend Developer & UI Designer',
                'features' => "Halaman materi per bab\nKuis interaktif dengan penilaian otomatis\nDashboard ringkasan nilai\nNavigasi materi yang mudah\nTampilan responsif untuk HP dan laptop",
                'image_url' => '/images/projects/web-sekolah.png',
                'live_link' => 'https://web-pembelajaran-beryl.vercel.app/',
                'github_link' => 'https://github.com/Blazer62/web-pembelajaran',
                'tech_stack' => 'HTML, CSS, JavaScript, Bootstrap',
                'documentation' => "Proses dimulai dengan wawancara singkat kepada guru untuk mengetahui materi yang paling sering diulang.\n\nSaya membuat alur sederhana: pilih bab, baca materi, lalu kerjakan kuis. Setiap kuis menyimpan skor sementara agar siswa bisa melihat hasilnya.\n\nDesain dibuat bersih dengan warna yang tidak melelahkan mata. Saya juga menambahkan indikator progres agar siswa tahu posisi materinya.\n\nSetelah uji coba di kelas, saya memperbaiki ukuran tombol dan menambahkan pesan yang lebih jelas saat jawaban salah.",
                'feedback' => 'Guru merasa materi lebih mudah disampaikan dan siswa lebih antusias mengerjakan kuis. Masukan utama adalah agar materi bisa diunduh, yang menjadi rencana pengembangan berikutnya.',
                'sort_order' => 3,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['title' => $project['title']],
                $project + [
                    'slug' => \Illuminate\Support\Str::slug($project['title']),
                    'is_featured' => true,
                ]
            );
        }
    }
}
