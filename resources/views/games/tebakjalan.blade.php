@extends('layouts.app')

@section('content')
    <style>
        /* --- PERBAIKAN NAVBAR AGAR TRANSPARAN --- */
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

        /* --- BULAN SABIT BERSINAR --- */
        .crescent-moon {
            position: absolute;
            top: 25px;
            right: 30px;
            font-size: 3.15rem;
            z-index: 2;
            filter: drop-shadow(0 0 18px rgba(253, 224, 71, 0.9));
            animation: moonGlow 3.5s ease-in-out infinite alternate;
            user-select: none;
            pointer-events: none;
        }

        @keyframes moonGlow {
            0% {
                transform: translateY(0px) rotate(-5deg);
                filter: drop-shadow(0 0 12px rgba(253, 224, 71, 0.7));
            }

            100% {
                transform: translateY(8px) rotate(5deg);
                filter: drop-shadow(0 0 25px rgba(253, 224, 71, 1));
            }
        }

        /* --- KARTU CONTAINER GAME --- */
        .game-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.35);
            max-width: 580px;
            margin: 0 auto;
        }

        .title-glow {
            font-family: 'Fredoka One', cursive, sans-serif;
            color: #38bdf8;
            text-shadow: 0 0 12px rgba(56, 189, 248, 0.6), 0 3px 6px rgba(0, 0, 0, 0.5);
        }

        /* --- DESAIN PILIHAN JAWABAN (OPTION BUTTONS) --- */
        .option-btn {
            border: 2px solid #38bdf8;
            border-radius: 50px;
            padding: clamp(0.65rem, 1.3vw, 0.95rem) clamp(0.85rem, 1.7vw, 1.4rem);
            font-size: clamp(0.88rem, 1.3vw, 1.05rem);
            font-weight: 700;
            color: #0284c7;
            background-color: #ffffff;
            transition: all 0.25s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .btn-check:checked+.option-btn {
            background-color: #e0f2fe;
            border-color: #0284c7;
            color: #0369a1;
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.4);
            transform: scale(1.02);
        }

        .option-btn:hover {
            background-color: #f0f9ff;
            transform: translateY(-2px);
        }

        /* Skala elemen tebak game */
        .tebak-title {
            font-size: var(--fs-h1);
        }

        .tebak-hint {
            font-size: var(--fs-small);
        }

        .tebak-icon {
            font-size: clamp(3.5rem, 6vw, 5.2rem);
        }

        .tebak-question {
            font-size: clamp(0.98rem, 1.7vw, 1.25rem);
        }

        .tebak-option-key {
            font-size: clamp(0.88rem, 1.3vw, 1.05rem);
        }

        .tebak-option-emoji {
            font-size: clamp(1.4rem, 2.4vw, 1.95rem);
        }

        .submit-btn {
            background-color: #10b981;
            border: none;
            color: white;
            font-size: clamp(0.88rem, 1.2vw, 1.05rem);
            font-weight: 700;
            padding: clamp(0.55rem, 1vw, 0.75rem) clamp(1.8rem, 2.8vw, 2.8rem);
            border-radius: 50px;
            box-shadow: 0 5px 14px rgba(16, 185, 129, 0.4);
            transition: all 0.2s ease;
        }

        .submit-btn:hover {
            background-color: #059669;
            transform: translateY(-2px);
            box-shadow: 0 7px 18px rgba(16, 185, 129, 0.5);
        }

        @media (max-width: 576px) {
            .crescent-moon {
                font-size: 2.2rem;
                top: 15px;
                right: 15px;
            }
            .tebak-icon {
                font-size: 2.8rem;
            }
        }
    </style>

    <div class="galaxy-section my-3">
        <!-- Lapisan Bintang & Meteor -->
        <div class="stars-bg"></div>
        <div class="shooting-star"></div>
        <div class="shooting-star"></div>

        <!-- 🌙 BULAN SABIT -->
        <div class="crescent-moon">🌙</div>

        <div class="container position-relative" style="z-index: 3;">

            <!-- TOMBOL NAVIGASI KE BERANDA -->
            <div class="text-center mb-3">
                <a href="{{ url('/') }}" class="btn btn-outline-light">
                    ← KEMBALI KE BERANDA
                </a>
            </div>

            <!-- JUDUL GAME -->
            <div class="text-center mb-4">
                <h1 class="tebak-title fw-bold title-glow">
                    🎮 TEBAK YUK!
                </h1>
                <p class="tebak-hint text-white-50 text-uppercase fw-semibold">
                    PETUNJUK: BACA PERTANYAAN DI BAWAH INI DAN PILIH JAWABAN YANG SESUAI!
                </p>
            </div>

            <!-- PESAN NOTIFIKASI BENAR / SALAH -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-pill text-center fw-bold shadow-sm mb-3 mx-auto"
                    style="max-width: 580px;" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-pill text-center fw-bold shadow-sm mb-3 mx-auto"
                    style="max-width: 580px;" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- KARTU KUIS utama -->
            <div class="game-card p-3 p-md-4" style="max-width: 580px; margin: 0 auto;">
                <form action="{{ route('game.tebak.check') }}" method="POST" up-target="main">
                    @csrf

                    {{-- 1. IDENTITAS SOAL (ID & Index) DARI RECORD SOAL YANG SAMA --}}
                    <input type="hidden" name="question_id" value="{{ $question->id ?? (($question->index ?? 0) + 1) }}">
                    <input type="hidden" name="question_index" value="{{ $question->index ?? 0 }}">

                    {{-- 2. ICON / VISUAL SOAL DARI RECORD SOAL YANG SAMA --}}
                    @if(!empty($question->icon))
                        <div class="text-center mb-3">
                            <span class="d-inline-block tebak-icon" style="filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.2));">
                                {{ $question->icon }}
                            </span>
                        </div>
                    @endif

                    {{-- 3. PERTANYAAN DARI RECORD SOAL YANG SAMA --}}
                    <h3 class="tebak-question text-center fw-black text-dark mb-4 text-uppercase">
                        {{ $question->question ?? 'PILIH JAWABAN YANG TEPAT!' }}
                    </h3>

                    {{-- 4. PILIHAN JAWABAN (A, B, C) DARI RECORD SOAL YANG SAMA --}}
                    <div class="d-flex flex-column gap-2 mb-4">
                        @foreach(($question->options ?? []) as $key => $opt)
                            <div>
                                <input type="radio" class="btn-check" name="answer" id="option_{{ $key }}" value="{{ $opt['text'] ?? $key }}" autocomplete="off" required>
                                <label class="option-btn" for="option_{{ $key }}">
                                    <span><strong class="tebak-option-key">{{ $key }}.</strong> {{ $opt['text'] ?? '' }}</span>
                                    <span class="tebak-option-emoji">{{ $opt['emoji'] ?? '' }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <!-- TOMBOL CEK JAWABAN -->
                    <div class="text-center">
                        <button type="submit" class="submit-btn">
                            CEK JAWABAN ✔
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- SCRIPT EFEK SUARA AUTOMATIS -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // --- EFEK SUARA DENGAN WEB AUDIO API ---
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

            // Putar Suara Berdasarkan Notifikasi dari Controller
            @if(session('success'))
                playSoundEffect('success');
            @endif

            @if(session('error'))
                playSoundEffect('error');
            @endif
            });
    </script>
@endsection