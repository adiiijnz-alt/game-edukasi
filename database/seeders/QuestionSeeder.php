<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel sebelum diisi ulang agar tidak menumpuk
        DB::table('questions')->truncate();

        DB::table('questions')->insert([
            [
                'category' => 'color_to_letter',
                'title' => 'Tebak kata dari kode warna',
                'elements' => json_encode(['Ungu', 'Kuning', 'Merah Muda', 'Oranye']),
                'answer' => 'labu',
                'options' => json_encode(['baju', 'labu', 'cabe', 'jari']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'math_icons',
                'title' => 'Hitung operasi matematika buah',
                'elements' => json_encode(['icon1' => 'mangga', 'operator' => '-', 'icon2' => 'anggur', 'value1' => 6, 'value2' => 4]),
                'answer' => '2',
                'options' => json_encode(['1', '2', '3', '5']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'shape_matching',
                'title' => 'Pilih susunan bangun datar yang sesuai untuk membentuk rumah',
                'elements' => json_encode(['target' => 'Rumah', 'shapes' => 'Trapesium, Persegi Panjang']),
                'answer' => 'b',
                'options' => json_encode(['a' => 'Opsi A', 'b' => 'Opsi B', 'c' => 'Opsi C']),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}