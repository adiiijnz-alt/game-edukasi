@extends('layouts.app')

@section('content')
    <style>
        /* --- PERBAIKAN NAVBAR HALAMAN BERANDA --- */
        /* Menimpa background navbar default agar transparan & teksnya putih */
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
        .beranda-section {
            background: linear-gradient(135deg, #1e053a 0%, #3b1578 40%, #a23409 100%);
            min-height: 100vh;
            padding: 50px 20px;
            border-radius: 30px;
            position: relative;
            overflow: hidden;
        }

        /* --- ANIMASI UFO MELAYANG --- */
        .ufo-container {
            position: absolute;
            top: 60px;
            right: 80px;
            z-index: 2;
            text-align: center;
            animation: ufoFloat 4s ease-in-out infinite alternate;
        }

        .ufo-icon {
            font-size: 5.5rem;
            filter: drop-shadow(0 0 15px rgba(56, 189, 248, 0.9));
        }

        /* Cahaya Sinar UFO (Beam Light) */
        .ufo-beam {
            width: 0;
            height: 0;
            border-left: 45px solid transparent;
            border-right: 45px solid transparent;
            border-bottom: 110px solid rgba(56, 189, 248, 0.25);
            margin: -20px auto 0 auto;
            filter: blur(2px);
            animation: beamPulse 2s ease-in-out infinite alternate;
        }

        @keyframes ufoFloat {
            0% {
                transform: translateY(0px) rotate(-3deg);
            }

            100% {
                transform: translateY(-25px) rotate(4deg);
            }
        }

        @keyframes beamPulse {
            0% {
                opacity: 0.3;
                transform: scaleX(0.8);
            }

            100% {
                opacity: 0.8;
                transform: scaleX(1.2);
            }
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
                radial-gradient(4px 4px at 50px 70px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(5px 5px at 120px 200px, #fde047, rgba(0, 0, 0, 0)),
                radial-gradient(4px 4px at 250px 90px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(5px 5px at 400px 280px, #38bdf8, rgba(0, 0, 0, 0)),
                radial-gradient(4px 4px at 550px 130px, #fde047, rgba(0, 0, 0, 0)),
                radial-gradient(6px 6px at 750px 220px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(4px 4px at 900px 100px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(5px 5px at 1050px 300px, #fde047, rgba(0, 0, 0, 0));
            background-repeat: repeat;
            background-size: 600px 350px;
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
            width: 180px;
            height: 4px;
            background: linear-gradient(90deg, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0));
            border-radius: 50%;
            filter: drop-shadow(0 0 10px #fff);
            animation: shoot 4.5s linear infinite;
            opacity: 0;
            z-index: 1;
        }

        .shooting-star:nth-child(1) {
            left: 10%;
            animation-delay: 0s;
        }

        .shooting-star:nth-child(2) {
            left: 40%;
            animation-delay: 2s;
        }

        .shooting-star:nth-child(3) {
            left: 70%;
            animation-delay: 1.2s;
        }

        @keyframes shoot {
            0% {
                transform: translateX(0) translateY(0) rotate(-45deg);
                opacity: 1;
                width: 180px;
            }

            25% {
                transform: translateX(-300px) translateY(300px) rotate(-45deg);
                opacity: 0;
                width: 0px;
            }

            100% {
                opacity: 0;
            }
        }

        /* --- STYLES KARTU & HERO SECTION --- */
        .hero-card {
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            border: 3px solid #38bdf8;
            border-radius: 28px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            color: white;
            padding: 50px 40px;
            position: relative;
            z-index: 2;
        }

        .main-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            border: 3px solid #f97316;
            border-radius: 28px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
        }

        .animated-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .animated-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .2) !important;
        }
    </style>

    <!-- CONTAINER UTAMA HALAMAN BERANDA -->
    <div class="beranda-section my-4">
        <!-- Lapisan Bintang -->
        <div class="stars-bg"></div>

        <!-- Bintang Jatuh / Meteor -->
        <div class="shooting-star"></div>
        <div class="shooting-star"></div>
        <div class="shooting-star"></div>

        <!-- UFO Terbang Melayang dengan Sinar Cahaya -->
        <div class="ufo-container">
            <div class="ufo-icon">🛸</div>
            <div class="ufo-beam"></div>
        </div>

        <div class="container position-relative" style="max-width: 950px; z-index: 2;">

            <!-- HERO SECTION BANNER UTAMA -->
            <div class="hero-card mb-5 animated-card position-relative overflow-hidden">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <span class="badge bg-warning text-dark fs-6 px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm">
                            🚀 Media Pembelajaran Interaktif
                        </span>
                        <h1 class="fw-bold display-4 mb-3" style="font-family: 'Fredoka One', cursive;">
                            Belajar Coding Jadi Lebih Seru! 🎮
                        </h1>
                        <p class="fs-5 opacity-90 mb-4 lh-base">
                            Asah logika, selesaikan teka-teki warna, matematika, dan bantu karakter menyelesaikan tantangan!
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ url('/bermain') }}"
                                class="btn btn-warning btn-lg fw-bold px-4 py-3 rounded-pill shadow">
                                🎮 Mulai Bermain Sekarang!
                            </a>
                            <a href="{{ url('/modul-belajar') }}"
                                class="btn btn-outline-light btn-lg fw-bold px-4 py-3 rounded-pill">
                                📖 Modul Belajar
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 text-center d-none d-md-block">
                        <div style="font-size: 8rem; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.3));">
                            🧩
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION MENGAPA BELAJAR DI EDUGAME ANAK -->
            <div class="main-card p-4 p-md-5 mb-5 animated-card">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary display-6" style="font-family: 'Fredoka One', cursive;">
                        ✨ Mengapa Belajar di EduGame Anak?
                    </h2>
                </div>

                <div class="row g-4 text-center mt-2">
                    <div class="col-md-4">
                        <div class="p-3">
                            <div class="fs-1 mb-3">🎯</div>
                            <h4 class="fw-bold text-dark">Interaktif & Seru</h4>
                            <p class="text-secondary small mb-0">
                                Anak-anak belajar konsep coding dan logika melalui permainan yang menyenangkan.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3">
                            <div class="fs-1 mb-3">🧠</div>
                            <h4 class="fw-bold text-dark">Melatih Logika</h4>
                            <p class="text-secondary small mb-0">
                                Mengasah pemikiran komputasional, pola warna, huruf, dan matematika dasar.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3">
                            <div class="fs-1 mb-3">👶</div>
                            <h4 class="fw-bold text-dark">Ramah Anak</h4>
                            <p class="text-secondary small mb-0">
                                Tampilan visual yang menarik, cerah, dan mudah digunakan oleh anak-anak.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER BAWAH -->
            <div class="d-flex justify-content-center gap-4 mt-5 pt-4 border-top border-light text-white-50">
                <div class="fw-bold text-warning">🎮 EduGame Anak</div>
                <a href="{{ url('/modul-belajar') }}" class="text-decoration-none text-white-50">Modul Belajar</a>
                <a href="{{ url('/tentang') }}" class="text-decoration-none text-white-50">Tentang Kami</a>
            </div>

        </div>
    </div>
@endsection