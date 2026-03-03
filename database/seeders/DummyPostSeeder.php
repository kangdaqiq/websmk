<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class DummyPostSeeder extends Seeder
{
    public function run()
    {
        // Get the first user or create one if none exists
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('password'),
            ]);
        }

        $posts = [
            [
                'title' => 'Kegiatan Kunjungan Industri ke Perusahaan Teknologi',
                'content' => '<p>Siswa-siswi SMK kita baru saja menyelesaikan kegiatan kunjungan industri ke beberapa perusahaan teknologi terkemuka di ibu kota. Kegiatan ini bertujuan untuk memberikan wawasan langsung mengenai dunia kerja yang sebenarnya, khususnya dalam bidang rekayasa perangkat lunak dan jaringan.</p><p>Para siswa sangat antusias mengikuti setiap sesi, mulai dari pengenalan struktur perusahaan hingga melihat langsung proses kerja para profesional di bidang IT.</p>',
            ],
            [
                'title' => 'Prestasi Membanggakan Lomba LKS Tingkat Provinsi',
                'content' => '<p>Perwakilan dari sekolah kita berhasil meraih juara 1 pada ajang Lomba Kompetensi Siswa (LKS) bidang Web Technologies di tingkat Provinsi. Prestasi ini sangat membanggakan dan menjadi motivasi bagi siswa lainnya untuk terus berprestasi.</p><p>Kepala Sekolah menyampaikan apresiasi setinggi-tingginya kepada para siswa dan guru pembimbing yang telah bekerja keras mempersiapkan lomba ini sejak enam bulan lalu.</p>',
            ],
            [
                'title' => 'Pendaftaran Peserta Didik Baru (PPDB) Telah Dibuka',
                'content' => '<p>Kabar gembira! Pendaftaran Peserta Didik Baru (PPDB) untuk tahun ajaran baru telah resmi dibuka. Segera daftarkan putra/putri Anda dan jadilah bagian dari sekolah kami yang berprestasi dan mengedepankan pendidikan karakter.</p><p>Pendaftaran dapat dilakukan secara online melalui website resmi atau langsung datang ke sekretariat pendaftaran di kampus utama kita. Tersedia beasiswa bagi siswa yang berprestasi dan kurang mampu.</p>',
            ],
            [
                'title' => 'Workshop Technopreneur Bersama Alumni Sukses',
                'content' => '<p>Sekolah mengadakan workshop technopreneur yang diisi oleh alumni-alumni sukses yang telah berkiprah di dunia startup dan desain grafis. Acara ini sangat bermanfaat untuk membangun jiwa wirausaha di kalangan siswa sejak dini.</p><p>Acara diakhiri dengan sesi tanya jawab dan pemberian doorprize menarik dari para narasumber.</p>',
            ]
        ];

        foreach ($posts as $index => $post) {
            Post::create([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']) . '-' . rand(100, 999),
                'content' => $post['content'],
                'image' => null, // Using null to let the frontend handle the placeholder gracefully for now
                'status' => 'published',
                'user_id' => $user->id,
            ]);
        }
    }
}
