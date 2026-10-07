<?php

namespace Tests\Feature;

use Tests\TestCase;

class GameValidationTest extends TestCase
{
    /**
     * Test 1: Soal A -> Jawaban benar A -> Hasil harus BENAR
     */
    public function test_correct_answer_returns_success_for_all_games(): void
    {
        // 1. Game Huruf: Soal ID 1 adalah "BOLA"
        $responseHuruf = $this->post(route('game.huruf.check'), [
            'question_id' => 1,
            'answer' => 'BOLA',
        ]);
        $responseHuruf->assertSessionHas('success');
        $responseHuruf->assertSessionMissing('error');

        // 2. Game Matematika: Soal ID 1 adalah 9 - 2 = 7
        $responseMath = $this->post(route('game.matematika.check'), [
            'question_id' => 1,
            'answer' => 7,
        ]);
        $responseMath->assertSessionHas('success');
        $responseMath->assertSessionMissing('error');

        // 3. Game Bentuk / Tebak: Soal ID 1 jawabannya "MONKEY"
        $responseTebak = $this->post(route('game.tebak.check'), [
            'question_id' => 1,
            'answer' => 'MONKEY',
        ]);
        $responseTebak->assertSessionHas('success');
        $responseTebak->assertSessionMissing('error');
    }

    /**
     * Test 2: Soal A -> Jawaban salah B -> Hasil harus SALAH
     */
    public function test_wrong_answer_returns_error_for_all_games(): void
    {
        // 1. Game Huruf: Soal ID 1 (BOLA), pemain menjawab SALAH (LABU)
        $responseHuruf = $this->post(route('game.huruf.check'), [
            'question_id' => 1,
            'answer' => 'LABU',
        ]);
        $responseHuruf->assertSessionHas('error');
        $responseHuruf->assertSessionMissing('success');

        // 2. Game Matematika: Soal ID 1 (9 - 2 = 7), pemain menjawab 10
        $responseMath = $this->post(route('game.matematika.check'), [
            'question_id' => 1,
            'answer' => 10,
        ]);
        $responseMath->assertSessionHas('error');
        $responseMath->assertSessionMissing('success');

        // 3. Game Bentuk: Soal ID 1 (MONKEY), pemain menjawab CAT
        $responseTebak = $this->post(route('game.tebak.check'), [
            'question_id' => 1,
            'answer' => 'CAT',
        ]);
        $responseTebak->assertSessionHas('error');
        $responseTebak->assertSessionMissing('success');
    }

    /**
     * Test 3: Soal B -> Jawaban benar B -> Hasil harus BENAR
     */
    public function test_second_question_returns_success_when_answered_correctly(): void
    {
        // 1. Game Huruf: Soal ID 2 adalah "LABU"
        $responseHuruf = $this->post(route('game.huruf.check'), [
            'question_id' => 2,
            'answer' => 'LABU',
        ]);
        $responseHuruf->assertSessionHas('success');

        // 2. Game Matematika: Soal ID 2 adalah 7 + 8 = 15
        $responseMath = $this->post(route('game.matematika.check'), [
            'question_id' => 2,
            'answer' => 15,
        ]);
        $responseMath->assertSessionHas('success');

        // 3. Game Bentuk: Soal ID 2 adalah "PLANE"
        $responseTebak = $this->post(route('game.tebak.check'), [
            'question_id' => 2,
            'answer' => 'PLANE',
        ]);
        $responseTebak->assertSessionHas('success');
    }

    /**
     * Test 4: Setelah randomisasi soal / pengacakan urutan -> jawaban tetap harus mengacu pada soal yang benar (berbasis ID)
     */
    public function test_id_based_lookup_survives_out_of_order_access(): void
    {
        // Akses soal ID 5 secara acak di Game Huruf ("CABE")
        $responseHuruf = $this->post(route('game.huruf.check'), [
            'question_id' => 5,
            'answer' => 'CABE',
        ]);
        $responseHuruf->assertSessionHas('success');

        // Akses soal ID 8 secara acak di Game Matematika (4 + 9 = 13)
        $responseMath = $this->post(route('game.matematika.check'), [
            'question_id' => 8,
            'answer' => 13,
        ]);
        $responseMath->assertSessionHas('success');

        // Akses soal ID 7 secara acak di Game Bentuk ("TRAIN")
        $responseTebak = $this->post(route('game.tebak.check'), [
            'question_id' => 7,
            'answer' => 'TRAIN',
        ]);
        $responseTebak->assertSessionHas('success');
    }

    /**
     * Test 5: Pilihan jawaban pada Tebak Yuk bisa dikirim berupa teks ataupun key opsi ('A', 'B', 'C')
     */
    public function test_tebak_yuk_supports_option_key_and_option_text(): void
    {
        // Soal ID 1: A: FISH, B: CAT, C: MONKEY. Jawaban benar: MONKEY
        // Kirim berupa text: "MONKEY"
        $resText = $this->post(route('game.tebak.check'), [
            'question_id' => 1,
            'answer' => 'MONKEY',
        ]);
        $resText->assertSessionHas('success');

        // Kirim berupa key opsi: "C"
        $resKey = $this->post(route('game.tebak.check'), [
            'question_id' => 1,
            'answer' => 'C',
        ]);
        $resKey->assertSessionHas('success');

        // Kirim opsi salah "A" (FISH)
        $resWrongKey = $this->post(route('game.tebak.check'), [
            'question_id' => 1,
            'answer' => 'A',
        ]);
        $resWrongKey->assertSessionHas('error');
    }

    /**
     * Test 6: Siklus bermain berulang kali & pemisahan state antar game
     */
    public function test_game_cycles_and_isolated_state(): void
    {
        // Main game huruf
        $this->withSession(['huruf_index' => 0]);
        $resHuruf = $this->post(route('game.huruf.check'), [
            'question_id' => 1,
            'answer' => 'BOLA',
        ]);
        $resHuruf->assertSessionHas('huruf_index', 1);

        // Pastikan matematika_index dan bentuk_index tidak terpengaruh
        $this->assertEquals(null, session('matematika_index'));
        $this->assertEquals(null, session('bentuk_index'));

        // Main game matematika
        $this->withSession(['matematika_index' => 0]);
        $resMath = $this->post(route('game.matematika.check'), [
            'question_id' => 1,
            'answer' => 7,
        ]);
        $resMath->assertSessionHas('matematika_index', 1);

        // Main game bentuk
        $this->withSession(['bentuk_index' => 0]);
        $resBentuk = $this->post(route('game.tebak.check'), [
            'question_id' => 1,
            'answer' => 'MONKEY',
        ]);
        $resBentuk->assertSessionHas('bentuk_index', 1);
    }

    /**
     * Test 7: Toleransi parameter 'question_id' dan 'question_index'
     */
    public function test_parameter_tolerance_both_question_id_and_index(): void
    {
        // Menggunakan question_index saja
        $resMathIndex = $this->post(route('game.matematika.check'), [
            'question_index' => 0, // index 0 adalah soal ID 1 (ans: 7)
            'answer' => 7,
        ]);
        $resMathIndex->assertSessionHas('success');

        // Menggunakan question_id saja
        $resMathId = $this->post(route('game.matematika.check'), [
            'question_id' => 1,
            'answer' => 7,
        ]);
        $resMathId->assertSessionHas('success');
    }

    /**
     * Test 8: Verifikasi view rendering memuat data dinamis
     */
    public function test_views_render_dynamically(): void
    {
        // View Huruf memuat warna dan petunjuk dinamis
        $resHuruf = $this->get(route('game.huruf'));
        $resHuruf->assertStatus(200);
        $resHuruf->assertSee('Petunjuk Kunci Warna');
        $resHuruf->assertSee('name="question_id"', false);

        // View Matematika memuat tabel petunjuk dan visual operasi
        $resMath = $this->get(route('game.matematika'));
        $resMath->assertStatus(200);
        $resMath->assertSee('Tabel Petunjuk');
        $resMath->assertSee('name="question_id"', false);

        // View Tebak memuat soal dan pilihan dinamis
        $resTebak = $this->get(route('game.tebak'));
        $resTebak->assertStatus(200);
        $resTebak->assertSee('name="question_id"', false);
    }
}
