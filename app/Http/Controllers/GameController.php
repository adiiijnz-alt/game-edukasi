<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    // ==========================================
    // QUESTION BANKS (PROPERTY CLASS)
    // ==========================================

    private array $questionBankHuruf = [
        [
            'id' => 1,
            'word' => 'BOLA',
            'legend' => ['merah' => 'B', 'biru' => 'O', 'ungu' => 'L', 'kuning' => 'A', 'oranye' => 'U', 'hijau' => 'E'],
            'colors' => ['merah', 'biru', 'ungu', 'kuning']
        ],
        [
            'id' => 2,
            'word' => 'LABU',
            'legend' => ['kuning' => 'A', 'biru' => 'O', 'hijau' => 'E', 'merah' => 'B', 'oranye' => 'U', 'ungu' => 'L'],
            'colors' => ['ungu', 'kuning', 'merah', 'oranye']
        ],
        [
            'id' => 3,
            'word' => 'MAJU',
            'legend' => ['kuning' => 'A', 'biru' => 'O', 'hijau' => 'U', 'merah' => 'J', 'oranye' => 'M', 'ungu' => 'L'],
            'colors' => ['oranye', 'kuning', 'merah', 'hijau']
        ],
        [
            'id' => 4,
            'word' => 'JARI',
            'legend' => ['kuning' => 'I', 'biru' => 'A', 'hijau' => 'E', 'merah' => 'J', 'oranye' => 'C', 'ungu' => 'R'],
            'colors' => ['merah', 'biru', 'ungu', 'kuning']
        ],
        [
            'id' => 5,
            'word' => 'CABE',
            'legend' => ['kuning' => 'A', 'biru' => 'O', 'hijau' => 'E', 'merah' => 'L', 'oranye' => 'C', 'ungu' => 'B'],
            'colors' => ['oranye', 'kuning', 'ungu', 'hijau']
        ],
        [
            'id' => 6,
            'word' => 'TOKO',
            'legend' => ['kuning' => 'A', 'biru' => 'O', 'hijau' => 'E', 'merah' => 'K', 'oranye' => 'U', 'ungu' => 'T'],
            'colors' => ['ungu', 'biru', 'merah', 'biru']
        ],
        [
            'id' => 7,
            'word' => 'KOPI',
            'legend' => ['kuning' => 'I', 'biru' => 'O', 'hijau' => 'E', 'merah' => 'K', 'oranye' => 'C', 'ungu' => 'P'],
            'colors' => ['merah', 'biru', 'ungu', 'kuning']
        ],
        [
            'id' => 8,
            'word' => 'SAPI',
            'legend' => ['kuning' => 'A', 'biru' => 'I', 'hijau' => 'S', 'merah' => 'J', 'oranye' => 'M', 'ungu' => 'P'],
            'colors' => ['hijau', 'kuning', 'ungu', 'biru']
        ],
        [
            'id' => 9,
            'word' => 'ROTI',
            'legend' => ['kuning' => 'I', 'biru' => 'A', 'hijau' => 'R', 'merah' => 'T', 'oranye' => 'O', 'ungu' => 'N'],
            'colors' => ['hijau', 'oranye', 'merah', 'kuning']
        ],
        [
            'id' => 10,
            'word' => 'SATE',
            'legend' => ['kuning' => 'A', 'biru' => 'O', 'hijau' => 'S', 'merah' => 'E', 'oranye' => 'U', 'ungu' => 'T'],
            'colors' => ['hijau', 'kuning', 'ungu', 'merah']
        ]
    ];

    private array $questionBankMatematika = [
        ['id' => 1, 'icon1' => '🦆', 'icon2' => '🪣', 'operator' => '-', 'value1' => 9, 'value2' => 2, 'ans' => 7],
        ['id' => 2, 'icon1' => '🚿', 'icon2' => '🧣', 'operator' => '+', 'value1' => 7, 'value2' => 8, 'ans' => 15],
        ['id' => 3, 'icon1' => '🧣', 'icon2' => '🪣', 'operator' => '-', 'value1' => 8, 'value2' => 2, 'ans' => 6],
        ['id' => 4, 'icon1' => '🦆', 'icon2' => '🪣', 'operator' => '+', 'value1' => 9, 'value2' => 2, 'ans' => 11],
        ['id' => 5, 'icon1' => '🦆', 'icon2' => '🌿', 'operator' => '-', 'value1' => 9, 'value2' => 3, 'ans' => 6],
        ['id' => 6, 'icon1' => '⚽', 'icon2' => '💧', 'operator' => '+', 'value1' => 6, 'value2' => 5, 'ans' => 11],
        ['id' => 7, 'icon1' => '🧣', 'icon2' => '☂️', 'operator' => '-', 'value1' => 8, 'value2' => 1, 'ans' => 7],
        ['id' => 8, 'icon1' => '🧥', 'icon2' => '🦆', 'operator' => '+', 'value1' => 4, 'value2' => 9, 'ans' => 13],
        ['id' => 9, 'icon1' => '🚿', 'icon2' => '☂️', 'operator' => '-', 'value1' => 7, 'value2' => 1, 'ans' => 6],
        ['id' => 10, 'icon1' => '🧣', 'icon2' => '💧', 'operator' => '+', 'value1' => 8, 'value2' => 5, 'ans' => 13],
    ];

    private array $questionBankBentuk = [
        [
            'id' => 1,
            'question' => 'HEWAN YANG SUKA MAKAN PISANG?',
            'icon' => '🍌',
            'options' => [
                'A' => ['text' => 'FISH', 'emoji' => '🐟'],
                'B' => ['text' => 'CAT', 'emoji' => '🐱'],
                'C' => ['text' => 'MONKEY', 'emoji' => '🐒'],
            ],
            'correct_answer' => 'MONKEY',
            'correct_option' => 'C',
            'ans' => 'MONKEY'
        ],
        [
            'id' => 2,
            'question' => 'KENDARAAN YANG TERBANG DI UDARA?',
            'icon' => '✈️',
            'options' => [
                'A' => ['text' => 'CAR', 'emoji' => '🚗'],
                'B' => ['text' => 'PLANE', 'emoji' => '✈️'],
                'C' => ['text' => 'SHIP', 'emoji' => '🚢'],
            ],
            'correct_answer' => 'PLANE',
            'correct_option' => 'B',
            'ans' => 'PLANE'
        ],
        [
            'id' => 3,
            'question' => 'BENDA UNTUK MENULIS DI BUKU?',
            'icon' => '✏️',
            'options' => [
                'A' => ['text' => 'PENCIL', 'emoji' => '✏️'],
                'B' => ['text' => 'BOOK', 'emoji' => '📖'],
                'C' => ['text' => 'BAG', 'emoji' => '🎒'],
            ],
            'correct_answer' => 'PENCIL',
            'correct_option' => 'A',
            'ans' => 'PENCIL'
        ],
        [
            'id' => 4,
            'question' => 'TEMPAT UNTUK BELAJAR?',
            'icon' => '🏫',
            'options' => [
                'A' => ['text' => 'HOSPITAL', 'emoji' => '🏥'],
                'B' => ['text' => 'SCHOOL', 'emoji' => '🏫'],
                'C' => ['text' => 'PARK', 'emoji' => '🏞️'],
            ],
            'correct_answer' => 'SCHOOL',
            'correct_option' => 'B',
            'ans' => 'SCHOOL'
        ],
        [
            'id' => 5,
            'question' => 'BENDA YANG MENUNJUKKAN WAKTU?',
            'icon' => '⏰',
            'options' => [
                'A' => ['text' => 'CLOCK', 'emoji' => '⏰'],
                'B' => ['text' => 'MIRROR', 'emoji' => '🪞'],
                'C' => ['text' => 'CHAIR', 'emoji' => '🪑'],
            ],
            'correct_answer' => 'CLOCK',
            'correct_option' => 'A',
            'ans' => 'CLOCK'
        ],
        [
            'id' => 6,
            'question' => 'BINTANG YANG BERSINAR PADA SIANG HARI?',
            'icon' => '☀️',
            'options' => [
                'A' => ['text' => 'MOON', 'emoji' => '🌙'],
                'B' => ['text' => 'STAR', 'emoji' => '⭐'],
                'C' => ['text' => 'SUN', 'emoji' => '☀️'],
            ],
            'correct_answer' => 'SUN',
            'correct_option' => 'C',
            'ans' => 'SUN'
        ],
        [
            'id' => 7,
            'question' => 'KENDARAAN YANG BERJALAN DI ATAS REL?',
            'icon' => '🚂',
            'options' => [
                'A' => ['text' => 'TRAIN', 'emoji' => '🚂'],
                'B' => ['text' => 'BUS', 'emoji' => '🚌'],
                'C' => ['text' => 'BICYCLE', 'emoji' => '🚲'],
            ],
            'correct_answer' => 'TRAIN',
            'correct_option' => 'A',
            'ans' => 'TRAIN'
        ],
        [
            'id' => 8,
            'question' => 'HEWAN YANG SUKA BERENANG DAN BERSUARA KWEK KWEK?',
            'icon' => '🦆',
            'options' => [
                'A' => ['text' => 'CAT', 'emoji' => '🐈'],
                'B' => ['text' => 'DUCK', 'emoji' => '🦆'],
                'C' => ['text' => 'DOG', 'emoji' => '🐕'],
            ],
            'correct_answer' => 'DUCK',
            'correct_option' => 'B',
            'ans' => 'DUCK'
        ],
        [
            'id' => 9,
            'question' => 'KENDARAAN YANG MEMILIKI DUA RODA DAN DIKAYUH?',
            'icon' => '🚲',
            'options' => [
                'A' => ['text' => 'CAR', 'emoji' => '🚗'],
                'B' => ['text' => 'BICYCLE', 'emoji' => '🚲'],
                'C' => ['text' => 'BUS', 'emoji' => '🚌'],
            ],
            'correct_answer' => 'BICYCLE',
            'correct_option' => 'B',
            'ans' => 'BICYCLE'
        ],
        [
            'id' => 10,
            'question' => 'HEWAN YANG SUKA MENANGKAP TIKUS?',
            'icon' => '🐱',
            'options' => [
                'A' => ['text' => 'CRAB', 'emoji' => '🦀'],
                'B' => ['text' => 'CAT', 'emoji' => '🐈'],
                'C' => ['text' => 'MONKEY', 'emoji' => '🐒'],
            ],
            'correct_answer' => 'CAT',
            'correct_option' => 'B',
            'ans' => 'CAT'
        ]
    ];

    /**
     * Helper lookup soal berdasarkan ID atau Index (dengan prioritas ID)
     */
    private function findQuestion(array $bank, $identifier): ?array
    {
        if ($identifier === null) {
            return null;
        }

        // 1. Cari berdasarkan 'id' unik
        foreach ($bank as $item) {
            if (isset($item['id']) && (string) $item['id'] === (string) $identifier) {
                return $item;
            }
        }

        // 2. Fallback jika identifier adalah index numerik array
        if (is_numeric($identifier) && isset($bank[(int) $identifier])) {
            return $bank[(int) $identifier];
        }

        return null;
    }

    // ==========================================
    // GENERAL & MODULE ROUTES
    // ==========================================

    public function index()
    {
        return view('home');
    }

    public function modulBelajar()
    {
        return view('belajar.index');
    }

    // ==========================================
    // GAME: CODING HURUF
    // ==========================================

    public function codingHuruf()
    {
        $currentIndex = session('huruf_index', 0);

        if ($currentIndex >= count($this->questionBankHuruf)) {
            $currentIndex = 0;
        }

        $selected = $this->questionBankHuruf[$currentIndex];

        $question = (object) [
            'id' => $selected['id'],
            'index' => $currentIndex,
            'category' => 'color_to_letter',
            'title' => 'TEBAK KATA DARI KODE WARNA',
            'legend' => $selected['legend'],
            'elements' => json_encode($selected['colors']),
            'answer' => $selected['word'],
        ];

        return view('games.huruf', compact('question'));
    }

    public function checkAnswerHuruf(Request $request)
    {
        $request->validate([
            'answer' => 'required|string',
            'question_id' => 'nullable',
            'question_index' => 'nullable',
        ]);

        $identifier = $request->input('question_id', $request->input('question_index'));
        $question = $this->findQuestion($this->questionBankHuruf, $identifier);

        if (!$question) {
            return back()->with('error', 'Terjadi kesalahan sistem, silakan coba lagi.');
        }

        $correctAnswer = $question['word'];
        $userAnswer = strtoupper(trim($request->answer));

        if ($userAnswer === strtoupper(trim($correctAnswer))) {
            $currentIndex = session('huruf_index', 0);
            $nextIndex = ($currentIndex + 1) % count($this->questionBankHuruf);
            session(['huruf_index' => $nextIndex]);

            return back()->with('success', 'HEBAT! JAWABAN KAMU BENAR! 🎉');
        } else {
            return back()->with('error', 'COBA LAGI YA! JAWABAN KURANG TEPAT. 😢');
        }
    }

    // Alias method agar kompatibel dengan route yang memanggil checkHuruf
    public function checkHuruf(Request $request)
    {
        return $this->checkAnswerHuruf($request);
    }

    // ==========================================
    // GAME: CODING MATEMATIKA
    // ==========================================

    public function codingMatematika()
    {
        $currentIndex = session('matematika_index', 0);

        if ($currentIndex >= count($this->questionBankMatematika)) {
            $currentIndex = 0;
        }

        $selected = $this->questionBankMatematika[$currentIndex];

        $question = (object) [
            'id' => $selected['id'],
            'index' => $currentIndex,
            'category' => 'math_icons',
            'title' => 'HITUNG OPERASI MATEMATIKA',
            'elements' => json_encode([
                'icon1' => $selected['icon1'],
                'icon2' => $selected['icon2'],
                'operator' => $selected['operator'],
                'value1' => $selected['value1'],
                'value2' => $selected['value2'],
            ]),
            'answer' => $selected['ans'],
        ];

        return view('games.matematika', compact('question'));
    }

    public function checkAnswerMatematika(Request $request)
    {
        $request->validate([
            'answer' => 'required|numeric',
            'question_id' => 'nullable',
            'question_index' => 'nullable',
        ]);

        $identifier = $request->input('question_id', $request->input('question_index'));
        $question = $this->findQuestion($this->questionBankMatematika, $identifier);

        if (!$question) {
            return back()->with('error', 'Terjadi kesalahan sistem, silakan coba lagi.');
        }

        $correctAnswer = $question['ans'];
        $userAnswer = trim($request->answer);

        if ((int) $userAnswer === (int) $correctAnswer) {
            $currentIndex = session('matematika_index', 0);
            $nextIndex = ($currentIndex + 1) % count($this->questionBankMatematika);
            session(['matematika_index' => $nextIndex]);

            return back()->with('success', 'HEBAT! PERHITUNGAN KAMU BENAR! 🎉');
        } else {
            return back()->with('error', 'COBA LAGI YA! PERHITUNGAN KURANG TEPAT. 😢');
        }
    }

    // ==========================================
    // GAME: TEBAK YUK / BENTUK
    // ==========================================

    public function codingBentuk()
    {
        $currentIndex = session('bentuk_index', 0);

        if ($currentIndex >= count($this->questionBankBentuk)) {
            $currentIndex = 0;
        }

        // Ambil SATU record soal utuh
        $selected = $this->questionBankBentuk[$currentIndex];

        // Pastikan seluruh komponen (ID, Pertanyaan, Pilihan, Icon, Jawaban Benar) berasal dari SATU data soal yang sama
        $question = (object) [
            'id' => $selected['id'],
            'index' => $currentIndex,
            'title' => 'TEBAK YUK!',
            'question' => $selected['question'],
            'options' => $selected['options'],
            'icon' => $selected['icon'] ?? '',
            'correct_answer' => $selected['correct_answer'] ?? $selected['ans'],
            'correct_option' => $selected['correct_option'] ?? '',
            'answer' => $selected['correct_answer'] ?? $selected['ans'],
        ];

        return view('games.tebakjalan', compact('question'));
    }

    public function checkAnswerBentuk(Request $request)
    {
        $request->validate([
            'answer' => 'required|string',
            'question_id' => 'nullable',
            'question_index' => 'nullable',
        ]);

        $identifier = $request->input('question_id', $request->input('question_index'));
        $question = $this->findQuestion($this->questionBankBentuk, $identifier);

        if (!$question) {
            return back()->with('error', 'Terjadi kesalahan sistem, silakan coba lagi.');
        }

        $correctAnswer = strtoupper(trim($question['correct_answer'] ?? $question['ans']));
        $correctOption = strtoupper(trim($question['correct_option'] ?? ''));
        $userAnswer = strtoupper(trim($request->answer));

        // Jika user mengirim key opsi ('A', 'B', 'C'), konversi ke teks opsi terkait
        if (isset($question['options'][$userAnswer]['text'])) {
            $userAnswer = strtoupper(trim($question['options'][$userAnswer]['text']));
        }

        // Cek kecocokan jawaban baik dengan teks jawaban maupun kode opsi yang benar
        $isCorrect = ($userAnswer === $correctAnswer) || 
                     (!empty($correctOption) && strtoupper(trim($request->answer)) === $correctOption);

        if ($isCorrect) {
            $currentIndex = session('bentuk_index', 0);
            $nextIndex = ($currentIndex + 1) % count($this->questionBankBentuk);
            session(['bentuk_index' => $nextIndex]);

            return back()->with('success', 'HEBAT! JAWABAN KAMU BENAR! 🎉');
        } else {
            return back()->with('error', 'COBA LAGI YA! JAWABAN KURANG TEPAT. 😢');
        }
    }
}