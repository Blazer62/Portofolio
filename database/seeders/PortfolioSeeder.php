<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Post;
use App\Models\SiteProfile;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $this->profile();
        $this->skills();
        $this->educations();
        $this->experiences();
        $this->certificates();
        $this->testimonials();
        $this->posts();
        $this->guestbook();
    }

    private function profile(): void
    {
        SiteProfile::updateOrCreate(['id' => 1], [
            'name' => 'Gusti Rizky Ananda',
            'headline' => 'Frontend Developer Intern',
            'tagline' => 'Membangun antarmuka web yang terstruktur, responsif, dan nyaman digunakan.',
            'bio' => 'Saya Gusti Rizky Ananda, siswa kelas XII Pengembangan Perangkat Lunak dan Gim (PPLG) yang fokus pada pengembangan antarmuka web. Saya senang mengubah desain menjadi halaman yang cepat, aksesibel, dan nyaman digunakan di berbagai ukuran layar. Bagi saya, detail kecil pada tampilan dan interaksi adalah bagian penting dari pengalaman pengguna.',
            'photo' => 'images/foto-profil.jpeg',
            'class' => 'XII',
            'major' => 'Pengembangan Perangkat Lunak dan Gim (PPLG)',
            'school' => 'SMKN 2 Banjarmasin',
            'location' => 'Banjarmasin, Kalimantan Selatan',
            'email' => 'gustyrizkyananda@gmail.com',
            'github' => 'https://github.com/Blazer62',
            'instagram' => 'https://www.instagram.com/gust1_rizky',
            'linkedin' => 'https://www.linkedin.com/in/gusti-rizky-ananda',
            'whatsapp' => 'https://wa.me/6285941927406',
            'tiktok' => 'https://www.tiktok.com/@agus_9176',
            'interests' => "UI/UX Design\nFrontend Development\nWeb Accessibility\nResponsive Design\nDesign System",
            'career_goal' => 'Menjadi frontend developer profesional yang mampu membangun produk digital yang cepat, aksesibel, dan berdampak bagi banyak pengguna. Dalam jangka panjang, saya ingin terlibat dalam pengembangan design system dan berbagi ilmu melalui tulisan serta komunitas belajar.',
            'cv_summary' => 'Siswa kelas XII jurusan Pengembangan Perangkat Lunak dan Gim (PPLG) di SMKN 2 Banjarmasin yang berfokus pada Frontend Web Development. Terbiasa membangun antarmuka web responsif, rapi, dan berpusat pada pengguna menggunakan HTML, CSS, JavaScript modern, serta Tailwind CSS. Memiliki semangat belajar tinggi, disiplin dalam kerja tim, dan siap berkontribusi secara produktif dalam program Magang / PKL Industri.',
            'languages' => "Bahasa Indonesia (Penutur Asli / Native)\nBahasa Inggris (Pasif / Pemahaman Dokumentasi Teknis)",
        ]);
    }

    private function skills(): void
    {
        $skills = [
            ['HTML', 90, 'hard'],
            ['CSS', 85, 'hard'],
            ['JavaScript', 80, 'hard'],
            ['Tailwind CSS', 85, 'hard'],
            ['Git & GitHub', 75, 'hard'],
            ['Responsive Design', 85, 'hard'],
            ['Komunikasi', 85, 'soft'],
            ['Kerja Tim', 90, 'soft'],
            ['Problem Solving', 80, 'soft'],
            ['Manajemen Waktu', 75, 'soft'],
        ];

        foreach ($skills as $index => [$name, $percentage, $type]) {
            Skill::updateOrCreate(
                ['name' => $name, 'type' => $type],
                ['percentage' => $percentage, 'sort_order' => $index + 1]
            );
        }
    }

    private function educations(): void
    {
        $educations = [
            [
                'level' => 'SMK',
                'institution' => 'SMKN 2 Banjarmasin',
                'major' => 'Pengembangan Perangkat Lunak dan Gim (PPLG)',
                'start_year' => '2024',
                'end_year' => '2027',
                'description' => 'Mempelajari pemrograman, pengembangan web, basis data, dan UI/UX pada jurusan Pengembangan Perangkat Lunak dan Gim. Fokus pada proyek sekolah dan latihan membangun antarmuka web.',
                'sort_order' => 1,
            ],
            [
                'level' => 'MTs',
                'institution' => 'MTs Al-Mawahib',
                'major' => null,
                'start_year' => '2021',
                'end_year' => '2024',
                'description' => 'Menempuh pendidikan menengah pertama sambil mulai mengenal teknologi dan dasar-dasar komputer melalui ekstrakurikuler dan tugas sekolah.',
                'sort_order' => 2,
            ],
            [
                'level' => 'MI',
                'institution' => 'Madrasah Ibtidaiyah',
                'major' => null,
                'start_year' => '2015',
                'end_year' => '2021',
                'description' => 'Menempuh pendidikan dasar dan mulai tertarik pada dunia komputer.',
                'sort_order' => 3,
            ],
        ];

        foreach ($educations as $education) {
            Education::updateOrCreate(
                ['level' => $education['level'], 'institution' => $education['institution']],
                $education
            );
        }
    }

    private function experiences(): void
    {
        $experiences = [
            [
                'type' => 'plk',
                'title' => 'Frontend Developer (Praktik Kerja Lapangan)',
                'organization' => 'Tim G.R.A.N.D',
                'period' => '2 Bulan',
                'description' => "- Mengembangkan dan memelihara antarmuka website berbasis responsif menggunakan HTML, CSS, dan Tailwind CSS.\n- Memastikan kenyamanan dan konsistensi tampilan antarmuka (UI/UX) di berbagai resolusi layar ponsel hingga desktop.\n- Berkolaborasi secara aktif dalam tim untuk menyusun komponen antarmuka yang rapi, terstruktur, dan mudah dirawat.\n- Melakukan cross-browser testing serta perbaikan bug tata letak tampilan untuk meningkatkan user experience.",
                'sort_order' => 1,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::updateOrCreate(
                ['type' => $experience['type'], 'title' => $experience['title']],
                $experience
            );
        }
    }

    private function certificates(): void
    {
        $certificates = [
            [
                'title' => 'Sertifikat Pra-Magang – Disperdagin',
                'issuer' => 'Dinas Perdagangan dan Perindustrian',
                'year' => '2026',
                'description' => 'Kegiatan pra-magang di bidang metrologi: memeriksa dan menguji kesesuaian timbangan dengan standar yang berlaku, lalu mencatat hasil pemeriksaan.',
                'sort_order' => 1,
            ],
        ];

        foreach ($certificates as $certificate) {
            Certificate::updateOrCreate(
                ['title' => $certificate['title'], 'year' => $certificate['year']],
                $certificate
            );
        }
    }

    private function testimonials(): void
    {
        $testimonials = [
            [
                'name' => 'Ahmad Fauzi, S.Kom.',
                'role' => 'Guru Produktif PPLG',
                'type' => 'guru',
                'message' => 'Gusti memiliki rasa ingin tahu yang tinggi dan tidak mudah menyerah ketika menemui error. Ia terbiasa merapikan kode dan memperhatikan detail tampilan, sehingga hasil kerjanya selalu rapi.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Rizky Maulana',
                'role' => 'Teman sekelas & rekan tim proyek',
                'type' => 'teman',
                'message' => 'Saat mengerjakan proyek kelompok, Gusti selalu membagi tugas dengan jelas dan membantu bagian yang sulit. Komunikasinya enak, dan hasil desainnya konsisten dengan rencana awal.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Siti Rahmawati',
                'role' => 'Guru pengguna Web Pembelajaran',
                'type' => 'pengguna',
                'message' => 'Web pembelajarannya mudah dipakai, tampilannya bersih, dan tetap nyaman dibuka di HP. Materi jadi lebih mudah disampaikan ke siswa.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Dedi Kurniawan',
                'role' => 'Supervisor PLK',
                'type' => 'plk',
                'message' => 'Selama PLK, Gusti cepat beradaptasi dengan alur kerja tim dan bertanggung jawab pada tugas yang diberikan. Hasil pekerjaannya sesuai target dan siap dipakai.',
                'sort_order' => 4,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                ['name' => $testimonial['name'], 'type' => $testimonial['type']],
                $testimonial
            );
        }
    }

    private function posts(): void
    {
        $posts = [
            [
                'title' => '5 Konsep JavaScript yang Wajib Dikuasai Pemula',
                'tag' => 'JavaScript',
                'excerpt' => 'Variabel, fungsi, DOM, event, dan array methods. Lima konsep ini menjadi fondasi sebelum kamu masuk ke framework.',
                'content' => "Belajar JavaScript terasa luas karena cakupannya banyak. Agar tidak bingung, mulai dari lima konsep dasar berikut.\n\n1. Variabel dan tipe data\nGunakan const untuk nilai yang tidak berubah dan let untuk nilai yang berubah. Pahami perbedaan string, number, boolean, array, dan object.\n\n2. Fungsi\nFungsi membuat kode bisa dipakai ulang. Biasakan menulis fungsi dengan nama yang jelas dan satu tanggung jawab.\n\n3. DOM\nDOM adalah jembatan antara JavaScript dan HTML. Coba querySelector, textContent, dan classList untuk mengubah tampilan.\n\n4. Event\nInteraksi pengguna ditangkap lewat event. Mulai dari click, input, hingga submit, lalu hubungkan dengan fungsi yang sesuai.\n\n5. Array methods\nmap, filter, dan reduce membantu mengolah data tanpa loop manual yang panjang. Ketiganya sering dipakai di proyek nyata.\n\nLatihan kecil setiap hari lebih efektif daripada menonton banyak tutorial tanpa praktik.",
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Membangun Layout Responsif Tanpa Framework',
                'tag' => 'CSS',
                'excerpt' => 'Grid dan flexbox sudah cukup untuk membuat layout responsif. Ini pola yang saya pakai di proyek sekolah.',
                'content' => "Framework bukan syarat untuk membuat layout responsif. CSS modern sudah menyediakan alat yang cukup.\n\nMobile first\nMulai dari layar kecil, lalu tambahkan media query untuk layar yang lebih besar. Pendekatan ini membuat kode lebih mudah dirawat.\n\nGrid untuk struktur\nGunakan display: grid dan grid-template-columns dengan repeat(auto-fit, minmax(240px, 1fr)) agar kartu menyesuaikan lebar layar otomatis.\n\nFlexbox untuk isi komponen\nFlexbox cocok untuk menyusun tombol, navigasi, dan isi kartu agar sejajar.\n\nPerhatikan jarak dan ukuran teks\nGunakan satuan rem untuk teks dan gap yang konsisten. Jangan lupa uji di lebar 360px, 768px, dan 1280px.\n\nSisakan ruang napas\nLayout yang baik bukan hanya tentang muat, tetapi juga nyaman dibaca.",
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Cerita di Balik Proyek Pustaka Kode',
                'tag' => 'Cerita Proyek',
                'excerpt' => 'Dari catatan pribadi yang berantakan menjadi website referensi kode dengan pencarian dan kategori.',
                'content' => "Pustaka Kode berawal dari kebiasaan mencatat potongan kode di banyak tempat: notes, chat, dan file terpisah. Saat ingin memakainya lagi, saya sering lupa lokasinya.\n\nMasalah utama\nCatatan tersebar dan sulit dicari. Saya butuh satu tempat yang cepat diakses dan mudah dipindai.\n\nSolusi\nSaya membuat website sederhana dengan daftar snippet, pencarian, dan kategori. Fokusnya bukan fitur banyak, tetapi kecepatan menemukan kode yang tepat.\n\nProses\nSaya mulai dari struktur data sederhana, lalu membuat tampilan daftar. Setelah itu menambahkan pencarian dan memperbaiki tampilan di layar kecil.\n\nPelajaran\nFitur yang sedikit tetapi benar-benar dipakai lebih berharga daripada banyak fitur yang jarang dibuka. Proyek ini juga mengajarkan saya pentingnya penamaan dan struktur file.",
                'published_at' => now()->subDays(21),
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(['slug' => \Illuminate\Support\Str::slug($post['title'])], $post);
        }
    }

    private function guestbook(): void
    {
        $messages = [
            ['name' => 'Salma Aulia', 'role' => 'Teman sekelas', 'message' => 'Webnya rapi dan enak dilihat, terutama di HP. Semangat terus untuk proyek berikutnya!'],
            ['name' => 'Pak Fauzi', 'role' => 'Guru PPLG', 'message' => 'Portofolionya sudah menggambarkan proses belajar dengan baik. Pertahankan kerapian dan terus tambah karya.'],
        ];

        foreach ($messages as $message) {
            Message::updateOrCreate(
                ['name' => $message['name'], 'type' => 'guestbook'],
                [
                    'role' => $message['role'],
                    'message' => $message['message'],
                    'is_read' => true,
                ]
            );
        }
    }
}
