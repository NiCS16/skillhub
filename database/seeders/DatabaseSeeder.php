<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peserta;
use App\Models\Kelas;
use App\Models\Pendaftaran;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder Peserta
        $pesertaData = [
            ['nama' => 'Andi Pratama', 'email' => 'andi@example.com', 'telepon' => '081234567891', 'alamat' => 'Jakarta'],
            ['nama' => 'Budi Santoso', 'email' => 'budi@example.com', 'telepon' => '081234567892', 'alamat' => 'Bandung'],
            ['nama' => 'Citra Lestari', 'email' => 'citra@example.com', 'telepon' => '081234567893', 'alamat' => 'Surabaya'],
            ['nama' => 'Doni Saputra', 'email' => 'doni@example.com', 'telepon' => '081234567894', 'alamat' => 'Medan'],
            ['nama' => 'Eka Rahma', 'email' => 'eka@example.com', 'telepon' => '081234567895', 'alamat' => 'Yogyakarta'],
            ['nama' => 'Fajar Hadi', 'email' => 'fajar@example.com', 'telepon' => '081234567896', 'alamat' => 'Semarang'],
            ['nama' => 'Gita Maharani', 'email' => 'gita@example.com', 'telepon' => '081234567897', 'alamat' => 'Bali'],
            ['nama' => 'Hendra Wijaya', 'email' => 'hendra@example.com', 'telepon' => '081234567898', 'alamat' => 'Makassar'],
            ['nama' => 'Indah Puspita', 'email' => 'indah@example.com', 'telepon' => '081234567899', 'alamat' => 'Lampung'],
            ['nama' => 'Joko Prasetyo', 'email' => 'joko@example.com', 'telepon' => '081234567800', 'alamat' => 'Palembang']
        ];

        foreach ($pesertaData as $data) {
            Peserta::create($data);
        }

        // Seeder Kelas
        $kelasData = [
            ['nama_kelas' => 'Desain Grafis', 'deskripsi' => 'Belajar desain menggunakan Photoshop & Illustrator', 'instruktur' => 'Sari Utami'],
            ['nama_kelas' => 'Web Development', 'deskripsi' => 'Belajar Laravel, HTML, CSS, dan JavaScript', 'instruktur' => 'Rudi Hartono'],
            ['nama_kelas' => 'Digital Marketing', 'deskripsi' => 'Optimasi social media dan ads campaign', 'instruktur' => 'Maya Ayu'],
            ['nama_kelas' => 'UI/UX Design', 'deskripsi' => 'Dasar-dasar Figma, wireframe, dan prototyping', 'instruktur' => 'Dewi Lestari'],
            ['nama_kelas' => 'Data Science', 'deskripsi' => 'Belajar Python, Pandas, dan Machine Learning', 'instruktur' => 'Agus Putra']
        ];

        foreach ($kelasData as $data) {
            Kelas::create($data);
        }

        // Seeder Pendaftaran (Many-to-Many Pivot)
        $allPeserta = Peserta::all();
        $allKelas = Kelas::all();

        // Buat pendaftaran acak tanpa duplikasi
        foreach (range(1, 15) as $i) {
            $peserta = $allPeserta->random();
            $kelas = $allKelas->random();

            // Cek duplikasi peserta+kelas
            if (!Pendaftaran::where('peserta_id', $peserta->id)
                ->where('kelas_id', $kelas->id)
                ->exists()) 
            {
                Pendaftaran::create([
                    'peserta_id' => $peserta->id,
                    'kelas_id' => $kelas->id,
                    'tanggal_daftar' => Carbon::now()->subDays(rand(1, 30))->format('Y-m-d'),
                ]);
            }
        }

        echo "Seeder selesai dijalankan!\n";
    }
}