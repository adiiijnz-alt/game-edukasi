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
            background: linear-gradient(135deg, #0d0121 0%, #240a4a 40%, #5b1366 100%);
            min-height: 100vh;
            padding: 25px 14px;
            border-radius: 18px;
            position: relative;
            overflow: hidden;
        }

        /* --- BINTANG-BINTANG KECIL KELAP-KELIP --- */
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
            background-size: 500px 300px;
            opacity: 0.9;
            animation: twinkle 3s ease-in-out infinite alternate;
        }

        @keyframes twinkle {
            0% {
                opacity: 0.3;
            }

            100% {
                opacity: 1;
            }
        }

        /* --- BINTANG JATUH / METEOR --- */
        .shooting-star {
            position: absolute;
            top: -10px;
            width: 130px;
            height: 2.5px;
            background: linear-gradient(90deg, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0));
            border-radius: 50%;
            filter: drop-shadow(0 0 8px #fff);
            animation: shoot 5s linear infinite;
            opacity: 0;
            z-index: 1;
        }

        .shooting-star:nth-child(1) {
            left: 15%;
            animation-delay: 0s;
        }

        .shooting-star:nth-child(2) {
            left: 60%;
            animation-delay: 3s;
        }

        @keyframes shoot {
            0% {
                transform: translateX(0) translateY(0) rotate(-45deg);
                opacity: 1;
                width: 130px;
            }

            25% {
                transform: translateX(-240px) translateY(240px) rotate(-45deg);
                opacity: 0;
                width: 0px;
            }

            100% {
                opacity: 0;
            }
        }

        /* --- BINTANG BESAR BERSINAR --- */
        .big-star {
            position: absolute;
            top: 24px;
            right: 30px;
            font-size: 3.5rem;
            z-index: 2;
            filter: drop-shadow(0 0 22px #fde047);
            animation: bigStarGlow 3.5s ease-in-out infinite alternate;
            user-select: none;
            pointer-events: none;
        }

        @keyframes bigStarGlow {
            0% {
                transform: translateY(0px) scale(0.95) rotate(-5deg);
                filter: drop-shadow(0 0 14px rgba(253, 224, 71, 0.7));
            }

            100% {
                transform: translateY(8px) scale(1.08) rotate(10deg);
                filter: drop-shadow(0 0 28px rgba(253, 224, 71, 1));
            }
        }

        /* --- ANGKA-ANGKA BERTABURAN MELAYANG LAMBAT DARI BAWAH KE ATAS --- */
        .floating-numbers-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 2;
        }

        .floating-number {
            position: absolute;
            font-family: 'Fredoka One', cursive, sans-serif;
            font-weight: bold;
            color: rgba(255, 255, 255, 0.65);
            text-shadow: 0 0 10px rgba(56, 189, 248, 0.8), 0 0 16px rgba(253, 224, 71, 0.6);
            user-select: none;
            animation: floatUpSlow linear infinite;
        }

        @keyframes floatUpSlow {
            0% {
                transform: translateY(110vh) rotate(0deg) scale(0.8);
                opacity: 0;
            }

            15% {
                opacity: 0.85;
            }

            85% {
                opacity: 0.85;
            }

            100% {
                transform: translateY(-20vh) rotate(360deg) scale(1.15);
                opacity: 0;
            }
        }

        /* --- KARTU CONTAINER UTAMA --- */
        .game-box {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            border: 2px solid #38bdf8;
            border-radius: var(--card-radius);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .title-glow {
            font-family: 'Fredoka One', cursive;
            color: #ffffff;
            text-shadow: 0 0 12px rgba(56, 189, 248, 0.8), 0 3px 6px rgba(0, 0, 0, 0.5);
        }

        /* --- TABEL PETUNJUK ICON --- */
        .symbol-table th,
        .symbol-table td {
            text-align: center;
            vertical-align: middle;
            font-size: clamp(1rem, 1.8vw, 1.4rem);
            padding: 0.55rem 0.4rem !important;
        }

        /* Skala elemen matematika */
        .math-title {
            font-size: var(--fs-h1);
        }

        .math-desc {
            font-size: var(--fs-body);
        }

        .math-table-title {
            font-size: var(--fs-h5);
        }

        .math-soal-icon {
            font-size: clamp(2.8rem, 5vw, 4.2rem);
        }

        .math-soal-operator {
            font-size: clamp(2rem, 3.5vw, 3.15rem);
        }

        .math-soal-desc {
            font-size: var(--fs-body);
        }

        .math-input-hint {
            font-size: var(--fs-small);
        }

        @media (max-width: 576px) {
            .big-star {
                font-size: 2.3rem;
                top: 14px;
                right: 14px;
            }
            .symbol-table th, .symbol-table td {
                font-size: 0.95rem;
                padding: 0.35rem 0.2rem !important;
            }
            .math-soal-icon {
                font-size: 2.3rem;
            }
            .math-soal-operator {
                font-size: 1.6rem;
            }
        }
    </style>

    <div class="galaxy-section my-3">
        <!-- Lapisan Bintang & Meteor -->
        <div class="stars-bg"></div>
        <div class="shooting-star"></div>
        <div class="shooting-star"></div>

        <!-- ⭐ BINTANG BESAR BERSINAR -->
        <div class="big-star">⭐</div>

        <!-- 🔢 ANGKA-ANGKA BERTABURAN MELAYANG LAMBAT DARI BAWAH KE ATAS -->
        <div class="floating-numbers-container" id="numbersContainer"></div>

        <div class="container position-relative" style="max-width: 780px; z-index: 3;">

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
                <h1 class="math-title fw-bold title-glow">
                    🧮 Coding Matematika
                </h1>
                <p class="math-desc text-white-50 mb-0">
                    Petunjuk: Isilah pertanyaan sesuai dengan kode pada tabel di bawah.
                </p>
            </div>

            <!-- PESAN NOTIFIKASI BENAR / SALAH -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-pill text-center fw-bold fs-5 shadow-sm mb-4"
                    role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-pill text-center fw-bold fs-5 shadow-sm mb-4"
                    role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- TABEL PETUNJUK -->
            <div class="game-box p-3 p-md-4 mb-3 text-center">
                <h5 class="math-table-title fw-bold text-dark mb-3">Tabel Petunjuk</h5>
                <div class="table-responsive">
                    <table class="table table-bordered symbol-table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
                                <th>9</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>☂️</td>
                                <td>🪣</td>
                                <td>🌿</td>
                                <td>🧥</td>
                                <td>💧</td>
                                <td>⚽</td>
                                <td>🚿</td>
                                <td>🧣</td>
                                <td>🦆</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            @php
                $elements = is_string($question->elements) ? json_decode($question->elements, true) : (array) ($question->elements ?? []);
                $icon1 = $elements['icon1'] ?? '🦆';
                $icon2 = $elements['icon2'] ?? '🪣';
                $operator = $elements['operator'] ?? '-';
            @endphp

            <!-- KARTU SOAL & INPUT JAWABAN -->
            <div class="game-box p-3 p-md-4 text-center">
                <form action="{{ route('game.matematika.check') }}" method="POST">
                    @csrf

                    {{-- Kirim ID dan indeks soal agar sinkron dengan backend --}}
                    <input type="hidden" name="question_id" value="{{ $question->id ?? (($question->index ?? 0) + 1) }}">
                    <input type="hidden" name="question_index" value="{{ $question->index ?? 0 }}">

                    <!-- Visual Soal Matematika Simbol Dinamis -->
                    <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                        <span class="math-soal-icon">{{ $icon1 }}</span>
                        <span class="math-soal-operator fw-bold text-muted">{{ $operator }}</span>
                        <span class="math-soal-icon">{{ $icon2 }}</span>
                    </div>

                    <h5 class="math-soal-desc fw-bold text-dark mb-3">Berapa hasil dari operasi di atas?</h5>

                    <!-- Input Jawaban Angka -->
                    <div class="col-md-5 mx-auto mb-3">
                        <input type="number" name="answer"
                            class="form-control text-center fw-bold shadow-sm"
                            placeholder="Isi angka..." required autocomplete="off">
                    </div>

                    <p class="math-input-hint text-muted mb-3">Masukkan angka hasil perhitungan ke dalam kotak di atas.</p>

                    <button type="submit" class="btn btn-success fw-bold shadow px-4 py-2">
                        Cek Jawaban ✔
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- SCRIPT ANGKA MELAYANG LAMBAT & EFEK SUARA AUTOMATIS -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // --- GENERATE ANGKA-ANGKA BERTABURAN MELAYANG LAMBAT ---
            const numbersContainer = document.getElementById('numbersContainer');
            const totalNumbers = 20;

            for (let i = 0; i < totalNumbers; i++) {
                const numEl = document.createElement('span');
                numEl.className = 'floating-number';

                // Angka acak 0 - 9
                const randomNum = Math.floor(Math.random() * 10);
                numEl.textContent = randomNum;

                const leftPos = Math.random() * 95;
                const fontSize = Math.random() * 1.4 + 1.1;

                // Durasi melayang lambat (15 sampai 28 detik)
                const duration = Math.random() * 13 + 15;
                const delay = Math.random() * 12;

                numEl.style.left = leftPos + '%';
                numEl.style.fontSize = fontSize + 'rem';
                numEl.style.animationDuration = duration + 's';
                numEl.style.animationDelay = delay + 's';

                numbersContainer.appendChild(numEl);
            }

            // --- EFEK SUARA DENGAN WEB AUDIO API (SINTESIS NADA) ---
            function playSoundEffect(type) {
                try {
                    const AudioContext = window.AudioContext || window.webkitAudioContext;
                    if (!AudioContext) return;
                    const audioCtx = new AudioContext();

                    if (type === 'success') {
                        // Nada Melodi Ceria (C5 - E5 - G5 - C6)
                        const notes = [523.25, 659.25, 783.99, 1046.50];
                        notes.forEach((freq, index) => {
                            const osc = audioCtx.createOscillator();
                            const gain = audioCtx.createGain();

                            osc.type = 'sine';
                            osc.frequency.setValueAtTime(freq, audioCtx.currentTime + index * 0.1);

                            gain.gain.setValueAtTime(0.25, audioCtx.currentTime + index * 0.1);
                            gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + index * 0.1 + 0.35);

                            osc.connect(gain);
                            gain.connect(audioCtx.destination);

                            osc.start(audioCtx.currentTime + index * 0.1);
                            osc.stop(audioCtx.currentTime + index * 0.1 + 0.35);
                        });
                    } else if (type === 'error') {
                        // Nada Tetot Gagal (Low Sawtooth 220Hz ke 160Hz)
                        const freqs = [220, 160];
                        freqs.forEach((freq, index) => {
                            const osc = audioCtx.createOscillator();
                            const gain = audioCtx.createGain();

                            osc.type = 'sawtooth';
                            osc.frequency.setValueAtTime(freq, audioCtx.currentTime + index * 0.2);

                            gain.gain.setValueAtTime(0.3, audioCtx.currentTime + index * 0.2);
                            gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + index * 0.2 + 0.4);

                            osc.connect(gain);
                            gain.connect(audioCtx.destination);

                            osc.start(audioCtx.currentTime + index * 0.2);
                            osc.stop(audioCtx.currentTime + index * 0.2 + 0.4);
                        });
                    }
                } catch (e) {
                    console.log("Audio Context Error:", e);
                }
            }

            // Putar Suara Berdasarkan Notifikasi dari Controller Laravel
            @if(session('success'))
                playSoundEffect('success');
            @endif

            @if(session('error'))
                playSoundEffect('error');
            @endif
            });
    </script>
@endsection