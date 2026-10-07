@extends('layouts.app')

@section('content')
    <style>
        /* --- PERBAIKAN NAVBAR HALAMAN --- */
        .navbar,
        nav.navbar,
        header {
            background-color: transparent !important;
            background: transparent !important;
            box-shadow: none !important;
        }

        .navbar .nav-link,
        .navbar .navbar-brand {
            color: #ffffff !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
        }

        /* --- LATAR BELAKANG COSMIC GALAXY --- */
        .galaxy-section {
            background: linear-gradient(135deg, #1e053a 0%, #3b1578 40%, #a23409 100%);
            min-height: 100vh;
            padding: 22px 12px;
            border-radius: 16px;
            position: relative;
            overflow: hidden;
        }

        /* --- BINTANG KELAP-KELIP --- */
        .stars-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            background-image:
                radial-gradient(3px 3px at 50px 70px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(4px 4px at 120px 200px, #fde047, rgba(0, 0, 0, 0)),
                radial-gradient(3px 3px at 250px 90px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(4px 4px at 400px 280px, #38bdf8, rgba(0, 0, 0, 0)),
                radial-gradient(4px 4px at 550px 130px, #fde047, rgba(0, 0, 0, 0)),
                radial-gradient(5px 5px at 750px 220px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(3px 3px at 900px 100px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(4px 4px at 1050px 300px, #fde047, rgba(0, 0, 0, 0));
            background-repeat: repeat;
            background-size: 450px 260px;
            opacity: 0.9;
            animation: twinkle 2.5s ease-in-out infinite alternate;
        }

        @keyframes twinkle {
            0% {
                opacity: 0.4;
            }

            100% {
                opacity: 1;
            }
        }

        /* --- BINTANG JATUH / METEOR --- */
        .shooting-star {
            position: absolute;
            top: -10px;
            width: 125px;
            height: 3px;
            background: linear-gradient(90deg, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0));
            border-radius: 50%;
            filter: drop-shadow(0 0 8px #fff);
            animation: shoot 4.5s linear infinite;
            opacity: 0;
            z-index: 1;
        }

        .shooting-star:nth-child(1) {
            left: 10%;
            animation-delay: 0s;
        }

        .shooting-star:nth-child(2) {
            left: 45%;
            animation-delay: 2s;
        }

        @keyframes shoot {
            0% {
                transform: translateX(0) translateY(0) rotate(-45deg);
                opacity: 1;
                width: 125px;
            }

            25% {
                transform: translateX(-220px) translateY(220px) rotate(-45deg);
                opacity: 0;
                width: 0px;
            }

            100% {
                opacity: 0;
            }
        }

        /* --- BULAN SABIT --- */
        .crescent-moon {
            position: absolute;
            top: 28px;
            right: 35px;
            font-size: 3.5rem;
            z-index: 2;
            filter: drop-shadow(0 0 18px rgba(253, 224, 71, 0.9));
            animation: moonGlow 3s ease-in-out infinite alternate;
            user-select: none;
            pointer-events: none;
        }

        @keyframes moonGlow {
            0% {
                transform: translateY(0px) rotate(-5deg);
                filter: drop-shadow(0 0 12px rgba(253, 224, 71, 0.7));
            }

            100% {
                transform: translateY(10px) rotate(5deg);
                filter: drop-shadow(0 0 22px rgba(253, 224, 71, 1));
            }
        }

        /* --- HURUF ALFABET BERTERBANGAN --- */
        .floating-letters-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 2;
        }

        .floating-letter {
            position: absolute;
            font-family: 'Fredoka One', cursive, sans-serif;
            font-weight: bold;
            color: rgba(255, 255, 255, 0.7);
            text-shadow: 0 0 10px rgba(56, 189, 248, 0.8), 0 0 15px rgba(253, 224, 71, 0.5);
            user-select: none;
            animation: floatUp linear infinite;
        }

        @keyframes floatUp {
            0% {
                transform: translateY(105vh) rotate(0deg) scale(0.8);
                opacity: 0;
            }

            10% {
                opacity: 0.8;
            }

            90% {
                opacity: 0.8;
            }

            100% {
                transform: translateY(-15vh) rotate(360deg) scale(1.15);
                opacity: 0;
            }
        }

        /* --- KARTU CONTAINER UTAMA --- */
        .game-box {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            border: 2.5px solid #38bdf8;
            border-radius: var(--card-radius);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.35);
        }

        .title-glow {
            font-family: 'Fredoka One', cursive;
            color: #ffffff;
            text-shadow: 0 0 12px rgba(56, 189, 248, 0.8), 0 3px 6px rgba(0, 0, 0, 0.5);
        }

        /* Skala elemen game huruf */
        .huruf-title {
            font-size: var(--fs-h1);
        }

        .huruf-desc {
            font-size: var(--fs-body-lg);
        }

        .huruf-legend-title {
            font-size: var(--fs-h5);
        }

        .huruf-legend-letter {
            font-size: var(--fs-h3);
        }

        .huruf-color-circle-legend {
            width: clamp(40px, 5.5vw, 50px);
            height: clamp(40px, 5.5vw, 50px);
        }

        .huruf-color-circle-soal {
            width: clamp(45px, 6.5vw, 60px);
            height: clamp(45px, 6.5vw, 60px);
        }

        .huruf-operator {
            font-size: clamp(1.3rem, 2vw, 1.75rem);
        }
    </style>

    <div class="galaxy-section my-4">
        <!-- Lapisan Bintang & Meteor -->
        <div class="stars-bg"></div>
        <div class="shooting-star"></div>
        <div class="shooting-star"></div>

        <!-- BULAN SABIT -->
        <div class="crescent-moon">🌙</div>

        <!-- HURUF ALFABET BERTERBANGAN -->
        <div class="floating-letters-container" id="lettersContainer"></div>

        <div class="container position-relative" style="max-width: 900px; z-index: 3;">

            <!-- TOMBOL NAVIGASI ATAS -->
            <div class="d-flex justify-content-center gap-2 mb-3">
                <a href="{{ url('/') }}" class="btn btn-outline-light">
                    ← Kembali ke Beranda
                </a>
                <a href="{{ route('belajar.index') }}" class="btn btn-outline-info">
                    📖 Lihat Halaman Belajar
                </a>
            </div>

            <!-- JUDUL HALAMAN -->
            <div class="text-center mb-4">
                <h1 class="huruf-title fw-bold title-glow mb-1">
                    🎨 Coding Huruf
                </h1>
                <p class="huruf-desc text-white-50 mb-0">
                    Tulis huruf-huruf yang mewakili setiap warna lingkaran seperti contoh!
                </p>
            </div>

            <!-- PESAN NOTIFIKASI BENAR / SALAH -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-pill text-center fw-bold fs-6 shadow-sm mb-3 py-2 px-3"
                    role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-pill text-center fw-bold fs-6 shadow-sm mb-3 py-2 px-3"
                    role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @php
                $colorMap = [
                    'merah' => '#f87171',
                    'biru' => '#60a5fa',
                    'ungu' => '#c084fc',
                    'kuning' => '#fde047',
                    'oranye' => '#fb923c',
                    'hijau' => '#4ade80',
                    'toska' => '#2dd4bf',
                ];
                $legend = $question->legend ?? [];
                $elements = is_string($question->elements) ? json_decode($question->elements, true) : (array) ($question->elements ?? []);
            @endphp

            <!-- KARTU PETUNJUK KUNCI WARNA -->
            <div class="game-box p-3 p-md-4 mb-3 text-center">
                <h5 class="huruf-legend-title fw-bold text-dark mb-3">Petunjuk Kunci Warna</h5>
                <div class="d-flex justify-content-center align-items-center flex-wrap gap-3">
                    @foreach($legend as $colorName => $letter)
                        @php
                            $cKey = strtolower(trim($colorName));
                            $bgCol = $colorMap[$cKey] ?? '#94a3b8';
                        @endphp
                        <div class="text-center">
                            <div class="huruf-color-circle-legend rounded-circle mb-1 shadow-sm border mx-auto"
                                style="background-color: {{ $bgCol }};"
                                title="{{ ucfirst($colorName) }}"></div>
                            <span class="huruf-legend-letter fw-bold text-dark">{{ $letter }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- KARTU SOAL & INPUT JAWABAN -->
            <div class="game-box p-3 p-md-4 text-center">
                <form
                    action="{{ Route::has('games.huruf.check') ? route('games.huruf.check') : route('game.huruf.check') }}"
                    method="POST" id="gameForm">
                    @csrf

                    {{-- Kirim ID dan indeks soal agar sinkron dengan backend --}}
                    <input type="hidden" name="question_id" value="{{ $question->id ?? (($question->index ?? 0) + 1) }}">
                    <input type="hidden" name="question_index" value="{{ $question->index ?? 0 }}">

                    <!-- Lingkaran Soal Dinamis -->
                    <div class="d-flex justify-content-center align-items-center gap-2 mb-4 flex-wrap">
                        @foreach($elements as $cName)
                            @php
                                $cKey = strtolower(trim($cName));
                                $bgCol = $colorMap[$cKey] ?? '#94a3b8';
                            @endphp
                            <div class="huruf-color-circle-soal rounded-circle shadow-sm border"
                                style="background-color: {{ $bgCol }};"
                                title="{{ ucfirst($cName) }}"></div>
                        @endforeach
                        <span class="huruf-operator fw-bold text-muted">=</span>
                    </div>

                    <!-- Input Jawaban -->
                    <div class="col-md-6 mx-auto mb-3">
                        <input type="text" name="answer" id="answerInput"
                            class="form-control form-control-lg text-center text-uppercase fw-bold"
                            placeholder="KETIK JAWABAN DI SINI" required autocomplete="off">
                    </div>

                    <button type="submit" class="btn btn-success btn-lg fw-bold shadow px-4 py-2">
                        Cek Jawaban ✓
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- SCRIPT HURUF BERTERBANGAN & AUDIO EFEK SUARA -->
    <script>
        function initGameLetters() {
            const lettersContainer = document.getElementById('lettersContainer');
            if (!lettersContainer) return;
            lettersContainer.innerHTML = '';

            const alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            const totalLetters = 20;

            for (let i = 0; i < totalLetters; i++) {
                const letterEl = document.createElement('span');
                letterEl.className = 'floating-letter';
                letterEl.textContent = alphabet.charAt(Math.floor(Math.random() * alphabet.length));

                letterEl.style.left = (Math.random() * 95) + '%';
                letterEl.style.fontSize = (Math.random() * 1.4 + 1.0) + 'rem';
                letterEl.style.animationDuration = (Math.random() * 8 + 8) + 's';
                letterEl.style.animationDelay = (Math.random() * 10) + 's';

                lettersContainer.appendChild(letterEl);
            }

            const gameForm = document.getElementById('gameForm');
            const answerInput = document.getElementById('answerInput');
            if (gameForm && answerInput) {
                gameForm.addEventListener('submit', function () {
                    answerInput.value = answerInput.value.trim().toUpperCase();
                });
            }
        }

        function playSound(type) {
            const AudioCtx = window.AudioContext || window.webkitAudioContext;
            if (!AudioCtx) return;
            const audioCtx = new AudioCtx();

            if (type === 'success') {
                const notes = [523.25, 659.25, 783.99, 1046.50];
                notes.forEach((freq, index) => {
                    const osc = audioCtx.createOscillator();
                    const gain = audioCtx.createGain();
                    osc.type = 'triangle';
                    osc.frequency.value = freq;
                    gain.gain.setValueAtTime(0.3, audioCtx.currentTime + index * 0.12);
                    gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + index * 0.12 + 0.3);
                    osc.connect(gain);
                    gain.connect(audioCtx.destination);
                    osc.start(audioCtx.currentTime + index * 0.12);
                    osc.stop(audioCtx.currentTime + index * 0.12 + 0.3);
                });
            } else if (type === 'error') {
                const freqs = [220, 180];
                freqs.forEach((freq, index) => {
                    const osc = audioCtx.createOscillator();
                    const gain = audioCtx.createGain();
                    osc.type = 'sawtooth';
                    osc.frequency.value = freq;
                    gain.gain.setValueAtTime(0.3, audioCtx.currentTime + index * 0.2);
                    gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + index * 0.2 + 0.3);
                    osc.connect(gain);
                    gain.connect(audioCtx.destination);
                    osc.start(audioCtx.currentTime + index * 0.2);
                    osc.stop(audioCtx.currentTime + index * 0.2 + 0.3);
                });
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            initGameLetters();

            @if(session('success'))
                playSound('success');
            @endif

            @if(session('error'))
                playSound('error');
            @endif
                });

        document.addEventListener("up:fragment:loaded", function () {
            initGameLetters();
        });
    </script>
@endsection