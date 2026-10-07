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

        /* --- LATAR BELAKANG COSMIC GALAXY UTAMA --- */
        .galaxy-section {
            background: linear-gradient(135deg, #1e053a 0%, #3b1578 40%, #a23409 100%);
            min-height: 100vh;
            padding: 25px 12px;
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

        .shooting-star:nth-child(3) {
            left: 75%;
            animation-delay: 1.2s;
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

        /* --- STYLES ASTRONOT TERBANG --- */
        .astronaut-container {
            position: absolute;
            z-index: 10;
            text-align: center;
            pointer-events: none;
            user-select: none;
        }

        .astronaut-icon {
            font-size: 2.45rem;
            filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.9));
        }

        /* 1. Astronot Pojok Kiri (Melayang di samping kartu) */
        .astro-left-top {
            top: 80px;
            left: 15px;
            animation: hoverLeftTop 3.5s ease-in-out infinite alternate;
        }

        @keyframes hoverLeftTop {
            0% {
                transform: translateY(0px) rotate(-10deg);
            }

            100% {
                transform: translateY(22px) rotate(10deg);
            }
        }

        /* 2. Astronot Pojok Kanan (Melayang di samping kartu) */
        .astro-right-top {
            top: 80px;
            right: 15px;
            animation: hoverRightTop 4s ease-in-out infinite alternate;
        }

        @keyframes hoverRightTop {
            0% {
                transform: translateY(0px) rotate(10deg);
            }

            100% {
                transform: translateY(25px) rotate(-10deg);
            }
        }

        /* 3. Astronot Terbang Diagonal dari Pojok Kiri Bawah ke Pojok Kanan Atas */
        .astro-flying {
            bottom: -60px;
            left: -60px;
            z-index: 5;
            animation: flyDiagonal 10s linear infinite;
        }

        @keyframes flyDiagonal {
            0% {
                transform: translate(0, 0) rotate(20deg) scale(0.8);
                opacity: 0;
            }

            15% {
                opacity: 1;
            }

            85% {
                opacity: 1;
            }

            100% {
                transform: translate(105vw, -100vh) rotate(35deg) scale(1.15);
                opacity: 0;
            }
        }

        /* --- STYLES KARTU & DESAIN --- */
        .game-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 2.5px solid #38bdf8;
            border-radius: var(--card-radius);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.35);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .game-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px rgba(56, 189, 248, 0.35) !important;
        }

        .title-glow {
            font-family: 'Fredoka One', cursive;
            color: #ffffff;
            text-shadow: 0 0 12px rgba(56, 189, 248, 0.8), 0 3px 6px rgba(0, 0, 0, 0.5);
        }

        /* Skala elemen pilih game */
        .gamelist-title {
            font-size: var(--fs-hero);
        }

        .gamelist-desc {
            font-size: var(--fs-body-lg);
        }

        .gamelist-card-icon {
            font-size: var(--fs-icon-md);
        }

        .gamelist-card-title {
            font-size: var(--fs-h3);
        }

        .gamelist-card-desc {
            font-size: var(--fs-body);
            line-height: 1.5;
        }
    </style>

    <!-- CONTAINER UTAMA -->
    <div class="galaxy-section my-4">
        <!-- Lapisan Bintang -->
        <div class="stars-bg"></div>

        <!-- Bintang Jatuh / Meteor -->
        <div class="shooting-star"></div>
        <div class="shooting-star"></div>
        <div class="shooting-star"></div>

        <!-- 1. ASTRONOT KIRI -->
        <div class="astronaut-container astro-left-top">
            <div class="astronaut-icon">👨‍🚀</div>
        </div>

        <!-- 2. ASTRONOT KANAN -->
        <div class="astronaut-container astro-right-top">
            <div class="astronaut-icon">👩‍🚀</div>
        </div>

        <!-- 3. ASTRONOT TERBANG DARI BAWAH KE ATAS -->
        <div class="astronaut-container astro-flying">
            <div class="astronaut-icon">🧑‍🚀</div>
        </div>

        <div class="container position-relative" style="max-width: 1100px; z-index: 3;">

            <!-- JUDUL KONTEN -->
            <div class="text-center mb-4">
                <h1 class="gamelist-title fw-bold title-glow mb-2">
                    Pilih Permainanmu! 🎯
                </h1>
                <p class="gamelist-desc text-white-50 mb-0">
                    Pilih salah satu tantangan di bawah ini untuk melatih logika berpikirmu.
                </p>
            </div>

            <!-- KARTU PERMAINAN -->
            <div class="row g-3 justify-content-center">
                <!-- Game 1: Coding Huruf & Warna -->
                <div class="col-md-4">
                    <div class="card game-card h-100 p-3 text-center">
                        <div class="card-body d-flex flex-column justify-content-between p-0">
                            <div>
                                <div class="gamelist-card-icon mb-2">🎨</div>
                                <h3 class="gamelist-card-title fw-bold text-dark mb-1">Coding Huruf & Warna</h3>
                                <p class="gamelist-card-desc text-secondary mb-3">
                                    Ubah urutan warna-warni menjadi huruf rahasia dan tebak kata yang terbentuk.
                                </p>
                            </div>
                            <a href="{{ route('game.huruf') }}" class="btn btn-warning btn-lg fw-bold shadow-sm">
                                Mainkan Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Game 2: Coding Matematika -->
                <div class="col-md-4">
                    <div class="card game-card h-100 p-3 text-center">
                        <div class="card-body d-flex flex-column justify-content-between p-0">
                            <div>
                                <div class="gamelist-card-icon mb-2">🧮</div>
                                <h3 class="gamelist-card-title fw-bold text-dark mb-1">Coding Matematika</h3>
                                <p class="gamelist-card-desc text-secondary mb-3">
                                    Ubah gambar-gambar lucu menjadi angka, lalu selesaikan perhitungannya.
                                </p>
                            </div>
                            <a href="{{ route('game.matematika') }}" class="btn btn-warning btn-lg fw-bold shadow-sm">
                                Mainkan Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Game 3: Tebak Yuk! -->
                <div class="col-md-4">
                    <div class="card game-card h-100 p-3 text-center">
                        <div class="card-body d-flex flex-column justify-content-between p-0">
                            <div>
                                <div class="gamelist-card-icon mb-2">🚶</div>
                                <h3 class="gamelist-card-title fw-bold text-dark mb-1">Tebak Yuk!</h3>
                                <p class="gamelist-card-desc text-secondary mb-3">
                                    Tentukan Mana Yang Tepat Berdasarkan Petunjuk Soal.
                                </p>
                            </div>
                            <a href="{{ route('game.tebak') }}" class="btn btn-warning btn-lg fw-bold shadow-sm">
                                Mainkan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TOMBOL KEMBALI -->
            <div class="text-center mt-4 pt-2">
                <a href="{{ url('/') }}" class="btn btn-outline-light btn-lg">
                    ← Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
@endsection