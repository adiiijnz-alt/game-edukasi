<?php

namespace Tests\Feature;

use Tests\TestCase;

class ViewIntegrityTest extends TestCase
{
    /**
     * Helper to verify style tags are paired and content is not inside <style>
     */
    private function assertProperStyleTags(string $html): void
    {
        $openCount = substr_count(strtolower($html), '<style');
        $closeCount = substr_count(strtolower($html), '</style>');
        $this->assertEquals($openCount, $closeCount, "Style tags mismatch: <style> count is {$openCount} but </style> count is {$closeCount}");
    }

    /**
     * Test 1: Halaman Beranda (/) harus menampilkan seluruh konten dengan utuh
     */
    public function test_home_page_renders_all_content_outside_styles(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();

        // 1. Tag style harus berpasangan
        $this->assertProperStyleTags($html);

        // 2. Konten utama Beranda harus ada
        $response->assertSee('Belajar Coding Jadi Lebih Seru!');
        $response->assertSee('Mulai Bermain Sekarang!');
        $response->assertSee('Mengapa Belajar di EduGame Anak?');
        $response->assertSee('Interaktif & Seru', false);
        $response->assertSee('Melatih Logika');
        $response->assertSee('Ramah Anak');
        $response->assertSee('EduGame Anak');
        $response->assertSee('Tentang Kami');

        // 3. Pastikan konten muncul SETELAH penutupan tag style terakhir
        $lastStyleClose = strrpos($html, '</style>');
        $this->assertNotFalse($lastStyleClose, 'Tag </style> tidak ditemukan');

        $heroPos = strpos($html, 'Belajar Coding Jadi Lebih Seru!');
        $this->assertGreaterThan($lastStyleClose, $heroPos, 'Konten hero beranda berada di dalam tag <style>!');
    }

    /**
     * Test 2: Halaman Modul Belajar (/belajar) harus render lengkap
     */
    public function test_belajar_page_renders_properly(): void
    {
        $response = $this->get(route('belajar.index'));
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertProperStyleTags($html);

        $response->assertSee('YUK, BELAJAR BERSAMA!');
        $response->assertSee('Kenalan dengan Bahasa Pemrograman!');
        $response->assertSee('HTML');
        $response->assertSee('CSS');
        $response->assertSee('JavaScript');
        $response->assertSee('PHP');
        $response->assertSee('Python');
    }

    /**
     * Test 3: Halaman Pilih Game (/bermain dan /pilih-game)
     */
    public function test_game_list_page_renders_properly(): void
    {
        $response = $this->get('/bermain');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertProperStyleTags($html);

        $response->assertSee('Pilih Permainanmu!');
        $response->assertSee('Coding Huruf & Warna', false);
        $response->assertSee('Coding Matematika');
        $response->assertSee('Tebak Yuk!');
    }

    /**
     * Test 4: Game 1 - Huruf (/game/huruf)
     */
    public function test_game_huruf_renders_properly(): void
    {
        $response = $this->get(route('game.huruf'));
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertProperStyleTags($html);

        $response->assertSee('Coding Huruf');
        $response->assertSee('Petunjuk Kunci Warna');
        $response->assertSee('Cek Jawaban');
    }

    /**
     * Test 5: Game 2 - Matematika (/game/matematika)
     */
    public function test_game_matematika_renders_properly(): void
    {
        $response = $this->get(route('game.matematika'));
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertProperStyleTags($html);

        $response->assertSee('Coding Matematika');
        $response->assertSee('Tabel Petunjuk');
    }

    /**
     * Test 6: Game 3 - Tebak Yuk / Bentuk (/game/bentuk & /game/tebak)
     */
    public function test_game_tebak_renders_properly(): void
    {
        $response = $this->get(route('game.bentuk'));
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertProperStyleTags($html);

        $response->assertSee('TEBAK YUK!');
        $response->assertSee('CEK JAWABAN');

        $responseAlias = $this->get(route('game.tebak'));
        $responseAlias->assertStatus(200);
    }

    /**
     * Test 7: Halaman Tentang (/tentang)
     */
    public function test_tentang_page_renders_properly(): void
    {
        $response = $this->get(route('tentang'));
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertProperStyleTags($html);

        $response->assertSee('Mengenal EduGame Anak');
        $response->assertSee('Visi & Misi Kami', false);
    }
}
