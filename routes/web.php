<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\GameController;

Route::get('/', [GameController::class, 'index']);

// Halaman Bermain Utama
Route::get('/bermain', function () {
    return view('game_list');
});

// Halaman Pilih Game
Route::get('/pilih-game', function () {
    return view('game_list');
})->name('game.list');

// Modul Belajar
Route::get('/belajar', [GameController::class, 'modulBelajar'])->name('belajar.index');

// Rute Halaman Tentang (Terpisah)
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

// Rute untuk Modul Huruf
Route::get('/game/huruf', [GameController::class, 'codingHuruf'])->name('game.huruf');
Route::post('/game/huruf', [GameController::class, 'checkAnswerHuruf'])->name('game.huruf.check');

// Rute untuk Modul Matematika
Route::get('/game/matematika', [GameController::class, 'codingMatematika'])->name('game.matematika');
Route::post('/game/matematika', [GameController::class, 'checkAnswerMatematika'])->name('game.matematika.check');

// Rute untuk Modul Bentuk / Tebak Yuk!
// Satu rute dengan dua nama alias agar kompatibel dengan game_list maupun tebakjalan
Route::get('/game/bentuk', [GameController::class, 'codingBentuk'])->name('game.bentuk');
Route::get('/game/tebak', [GameController::class, 'codingBentuk'])->name('game.tebak');
Route::post('/game/bentuk/check', [GameController::class, 'checkAnswerBentuk'])->name('game.tebak.check');

// Rute Seeder Sementara untuk Memperbarui Soal
Route::get('/run-seeder', function () {
    // Kosongkan tabel questions terlebih dahulu
    DB::table('questions')->truncate();

    // Masukkan data soal
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

    return "Data pertanyaan berhasil dimasukkan!";
});