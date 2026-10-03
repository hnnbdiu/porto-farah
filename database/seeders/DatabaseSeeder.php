<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Achievement;
use App\Models\ProfileSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin',
            'email' => config('app.admin_email', 'admin@farahraihanun.dev'),
            'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
        ]);

        // Profile Setting
        ProfileSetting::create([
            'nama' => 'Farah Raihanun Badiu',
            'role' => 'Mahasiswa Teknik Informatika · Web Development, Machine Learning & GIS',
            'bio' => "Halo, perkenalkan nama saya Farah Raihanun Badiu. Saya adalah mahasiswa Teknik Informatika di Universitas Muhammadiyah Sorong yang memulai studi pada tahun 2025.\n\nFokus utama saya saat ini berada di irisan antara pengembangan web, pemodelan machine learning, dan Sistem Informasi Geografis (GIS). Saya terbiasa menggunakan ekosistem Python untuk mengolah data kompleks menjadi aplikasi interaktif dan visualisasi yang fungsional.\n\nMelalui portofolio ini, saya merangkum berbagai eksplorasi teknis dan proyek yang telah saya kembangkan. Saya selalu terbuka untuk terus belajar dan berkolaborasi dalam menciptakan inovasi digital.",
            'foto' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBaeT9JoLu4pmIcD8sv-wA6uT0CGA5iNVyh2DCmFLrBhAFWyc82s8ZAsLd1OgZcnayOu8Mab-Z9QxU39VKsT0eFu4hQ-T_jnSsakwfpNpe93VuhySnXnJVGA0wrXdEvY4fe5nHtQq02qzsS6z87JCrkUNjevCOexzv5Fu9ySYNwt4Jg5kQ8WBDtUKB4BX0RQJiEpM8AyHiDm4kOGZNeqajjvkIJk0Ep_fGo5SfyDTI2YckqpDis5Fw8-A',
            'sosial_media' => [
                'email' => 'halo@farahraihanun.dev',
                'github' => 'https://github.com/farahraihanun',
                'linkedin' => 'https://linkedin.com/in/farahraihanun',
                'instagram' => 'https://instagram.com/farahraihanun'
            ]
        ]);

        // Projects
        Project::create([
            'title' => 'Web GIS UMKM Malawele',
            'slug' => Str::slug('Web GIS UMKM Malawele'),
            'description' => 'Sistem Informasi Geografis pemetaan persebaran UMKM di Distrik Aimas/Malawele dengan analisis buffer interaktif dan filter kategori komprehensif.',
            'tech_stack' => ['Leaflet.js', 'PostGIS', 'Laravel', 'Spatial Buffer'],
            'github_url' => 'https://github.com',
            'demo_url' => '#',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBKNWoS5EV3SEPAtT_P3DuBIHyvRNT44o7gKhg329JdIZFRUsbh2eimQL_potFUkRACqykw6XovJeYn0kqg5Y5CE3kEJIXP5SaXwkZl52UrDe9JCehPb7wsHhJWSK9Eb9a5m-3K1ensiHPxP0OGmW6VHpyS8nwvp7CxNoladLY6ZLOv3DgCqT6xiGXXXJhrrA2GWqA7l8G7q3xzwppNyIU9yKCQ5cwN16JgWN2TFPIlkUD0Oce3q_ljkQ',
            'is_published' => true,
        ]);

        Project::create([
            'title' => 'Prediksi Harga Ikan (XGBoost)',
            'slug' => Str::slug('Prediksi Harga Ikan (XGBoost)'),
            'description' => 'Model regresi prediktif pergerakan harga komoditas ikan di pasar lokal Kota Sorong berdasarkan cuaca, pasang surut air laut, dan volume tangkapan dengan akurasi R² 0.89.',
            'tech_stack' => ['Python', 'XGBoost', 'Streamlit', 'Pandas'],
            'github_url' => 'https://github.com',
            'demo_url' => '#',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC2Uyrk1wbx8ZGAXiJXwaEshkAekOiTpS5Icwn1JthnVRardIXYY8cfdd_kUrJUhbIDkvDoswQ8NyL6HZq_EaTPWMx2ba2btYXcXsMAFU8o7glM93_xyx9asoY3tNpOKbs5aXL439G1_tIWJHkHWOl5bpbM-2Yhnc9HUdPX6NO5aZHz07gBlQJ210bFux6gDLNg3cHIS1Le9cvDB62tan8gDv8TaRe-weksdpqOWFt1fRHXcznm2AQO_w',
            'is_published' => true,
        ]);

        Project::create([
            'title' => 'Website Portofolio (Laravel/React)',
            'slug' => Str::slug('Website Portofolio (Laravel/React)'),
            'description' => 'Platform pameran digital berkinerja tinggi dengan arsitektur headless modern, animasi halus, dan waktu muat cepat.',
            'tech_stack' => ['React', 'Tailwind CSS', 'Laravel API', 'Vite'],
            'github_url' => 'https://github.com',
            'demo_url' => '#',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAkx53aTgAy8JLmKegARjpdrV2BYak4B5zRX87peVHOCVLUyICiTUyEgSnkpj_BaJfACg3gtE3vRsJ-EyeMMJ1ZRj8-YjGImq0Nkb-LUpiEtRrOWhcVT7lHw82qrvfwUOE9Y9NpAkN-a3ZWpVzVvKDuR30FzGUlBcxDPNW9KxiBifu_yG1XUA_ueDjftUTp2_ibJ-j-7Ab_2-8ptizN6sLYW93It3m7wiIGg9W9ufae_B-aQHVlFs0IRw',
            'is_published' => true,
        ]);

        // Skills
        $skills = [
            ['name' => 'Python', 'icon' => 'data_object', 'percentage' => 92, 'category' => 'Data Analysis & ML'],
            ['name' => 'Git & GitHub', 'icon' => 'fork_right', 'percentage' => 88, 'category' => 'Version Control & CI/CD'],
            ['name' => 'Streamlit', 'icon' => 'dashboard', 'percentage' => 85, 'category' => 'Data Dashboard & Apps'],
            ['name' => 'Machine Learning', 'icon' => 'psychology', 'percentage' => 82, 'category' => 'XGBoost & Scikit-Learn'],
            ['name' => 'Laravel', 'icon' => 'dns', 'percentage' => 86, 'category' => 'Backend & REST API'],
            ['name' => 'React', 'icon' => 'code_blocks', 'percentage' => 80, 'category' => 'Frontend & Interactive UI'],
            ['name' => 'PostgreSQL', 'icon' => 'database', 'percentage' => 85, 'category' => 'PostGIS & Spatial Database'],
        ];

        foreach ($skills as $i => $skill) {
            Skill::create($skill + ['sort_order' => $i]);
        }

        // Achievements
        Achievement::create([
            'title' => 'Digital Cartoon Artwork — Bawor International Cartoon Exhibition',
            'type' => 'International Exhibition Showcase',
            'description' => 'Terpilih dan berpartisipasi dalam pameran kartun internasional bereputasi, menyajikan karya kartun digital bertema kritik sosial dan teknologi modern. Menyoroti sinergi pemecahan masalah kreatif dan seni bercerita visual yang menjembatani sains komputer, seni rupa, dan empati humaniora.',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBLwbaA1nVlDOCmeDeJ5J7Z33fD5COGiJLDqe2a2TxQ2G1H2mwjzx3vA2T82hslDuBBrKwZ2dQox_GIpevraj4RyBBWWNo70tmAzj-elCz2YXHK1xQ5F2CmVC77MEt43WTqo74uvg8ao24BlX46XXbKeexEW05b51I0XyvQKW4mMgKNeZCNE8iFKCNbgxfeCDYKosa7JHvyzqognMFunphbd8K2lvSouIV8gl3Q-RF-tLsTu8b0CtKKgQ',
            'tags' => ['Curated Showcase', 'Vector & Digital Art', 'Award Finalist']
        ]);
    }
}
