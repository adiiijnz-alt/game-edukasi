@extends('layouts.app')

@section('content')
    <style>
        /* --- PERBAIKAN NAVBAR HALAMAN BERANDA --- */
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
            padding: 25px 12px;
            border-radius: 16px;
            position: relative;
            overflow: hidden;
        }

        /* --- STYLES DASAR UFO & CAHAYA --- */
        .ufo-container {
            position: absolute;
            z-index: 2;
            text-align: center;
            pointer-events: none;
        }

        .ufo-beam {
            width: 0;
            height: 0;
            border-left: 14px solid transparent;
            border-right: 14px solid transparent;
            border-bottom: 38px solid rgba(56, 189, 248, 0.25);
            margin: -8px auto 0 auto;
            filter: blur(2px);
            animation: beamPulse 2s ease-in-out infinite alternate;
        }

        /* --- 1. UFO KANAN ATAS --- */
        .ufo-top-right {
            top: 22px;
            right: 25px;
            animation: moveTopRight 5s ease-in-out infinite alternate;
        }

        .ufo-top-right .ufo-icon {
            font-size: 2.2rem;
            filter: drop-shadow(0 0 10px rgba(56, 189, 248, 0.9));
        }

        /* --- 2. UFO KIRI ATAS --- */
        .ufo-top-left {
            top: 25px;
            left: 25px;
            animation: moveTopLeft 6s ease-in-out infinite alternate;
            animation-delay: 1s;
        }

        .ufo-top-left .ufo-icon {
            font-size: 1.95rem;
            filter: drop-shadow(0 0 10px rgba(168, 85, 247, 0.9));
        }

        /* --- 3. UFO KANAN BAWAH --- */
        .ufo-bottom-right {
            bottom: 28px;
            right: 28px;
            animation: moveBottomRight 5.5s ease-in-out infinite alternate;
            animation-delay: 0.5s;
        }

        .ufo-bottom-right .ufo-icon {
            font-size: 1.85rem;
            filter: drop-shadow(0 0 10px rgba(250, 204, 21, 0.9));
        }

        /* --- 4. UFO KIRI BAWAH --- */
        .ufo-bottom-left {
            bottom: 32px;
            left: 28px;
            animation: moveBottomLeft 6.5s ease-in-out infinite alternate;
            animation-delay: 1.5s;
        }

        .ufo-bottom-left .ufo-icon {
            font-size: 1.95rem;
            filter: drop-shadow(0 0 10px rgba(74, 222, 128, 0.9));
        }

        /* --- 5. UFO SUPER CEPAT (MELINTAS HORIZON) --- */
        .ufo-fast {
            top: 35%;
            left: -120px;
            z-index: 3;
            animation: flyFast 4s linear infinite;
        }

        .ufo-fast .ufo-icon {
            font-size: 1.95rem;
            filter: drop-shadow(0 0 15px rgba(244, 63, 94, 1));
            transform: rotate(15deg);
        }

        /* --- KEYFRAMES GERAKAN 4 UFO CORNER --- */
        @keyframes moveTopRight {
            0% {
                transform: translateY(0px) rotate(-4deg);
            }

            100% {
                transform: translateY(100px) rotate(6deg);
            }
        }

        @keyframes moveTopLeft {
            0% {
                transform: translateY(0px) rotate(5deg);
            }

            100% {
                transform: translateY(110px) rotate(-5deg);
            }
        }

        @keyframes moveBottomRight {
            0% {
                transform: translateY(0px) rotate(-6deg);
            }

            100% {
                transform: translateY(-90px) rotate(5deg);
            }
        }

        @keyframes moveBottomLeft {
            0% {
                transform: translateY(0px) rotate(4deg);
            }

            100% {
                transform: translateY(-105px) rotate(-6deg);
            }
        }

        /* --- KEYFRAMES UFO CEPAT --- */
        @keyframes flyFast {
            0% {
                left: -150px;
                transform: translateY(0px) scale(0.7);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                left: 105vw;
                transform: translateY(-60px) scale(1.05);
                opacity: 0;
            }
        }

        @keyframes beamPulse {
            0% {
                opacity: 0.3;
                transform: scaleX(0.8);
            }

            100% {
                opacity: 0.85;
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

        /* --- STYLES KARTU & HERO SECTION --- */
        .hero-card {
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            border: 2.5px solid #38bdf8;
            border-radius: var(--card-radius);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.35);
            color: white;
            padding: clamp(1rem, 2.5vw, 2rem) clamp(0.75rem, 2vw, 1.7rem);
            position: relative;
            z-index: 2;
        }

        .main-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            border: 2.5px solid #f97316;
            border-radius: var(--card-radius);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.3);
        }

        .animated-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .animated-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.6rem 1.6rem rgba(0, 0, 0, .18) !important;
        }

        /* Skala elemen beranda */
        .home-hero-title {
            font-size: var(--fs-hero);
            font-family: 'Fredoka One', cursive;
            line-height: 1.2;
        }

        .home-hero-desc {
            font-size: var(--fs-body-lg);
            opacity: 0.9;
            line-height: 1.5;
        }

        .home-section-title {
            font-size: var(--fs-h2);
            font-family: 'Fredoka One', cursive;
        }

        .home-feature-icon {
            font-size: var(--fs-icon-md);
        }

        .home-feature-title {
            font-size: var(--fs-h4);
        }

        .home-feature-desc {
            font-size: var(--fs-body);
            line-height: 1.5;
        }

        .home-hero-emoji {
            font-size: var(--fs-icon-xl);
            filter: drop-shadow(0 6px 10px rgba(0,0,0,0.25));
        }

        .home-footer-link {
            font-size: var(--fs-body);
        }

        /* --- RESPONSIVE MOBILE UNTUK BERANDA --- */
        @media (max-width: 768px) {
            .beranda-section {
                padding: 12px 8px;
                border-radius: 12px;
            }

            .ufo-container .ufo-icon {
                font-size: 1.15rem !important;
            }

            .ufo-top-right {
                top: 8px;
                right: 8px;
            }

            .ufo-top-left {
                top: 10px;
                left: 8px;
            }

            .ufo-bottom-right {
                bottom: 12px;
                right: 8px;
            }

            .ufo-bottom-left {
                bottom: 15px;
                left: 8px;
            }

            .ufo-beam {
                display: none;
            }

            .hero-card {
                padding: 0.9rem 0.6rem;
            }

            .main-card {
                padding: 0.9rem 0.6rem !important;
            }
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

        <!-- 1. UFO KANAN ATAS (Cahaya Biru) -->
        <div class="ufo-container ufo-top-right">
            <div class="ufo-icon">🛸</div>
            <div class="ufo-beam"></div>
        </div>

        <!-- 2. UFO KIRI ATAS (Cahaya Ungu) -->
        <div class="ufo-container ufo-top-left">
            <div class="ufo-icon">🛸</div>
            <div class="ufo-beam"></div>
        </div>

        <!-- 3. UFO KANAN BAWAH (Cahaya Kuning) -->
        <div class="ufo-container ufo-bottom-right">
            <div class="ufo-icon">🛸</div>
            <div class="ufo-beam"></div>
        </div>

        <!-- 4. UFO KIRI BAWAH (Cahaya Hijau) -->
        <div class="ufo-container ufo-bottom-left">
            <div class="ufo-icon">🛸</div>
            <div class="ufo-beam"></div>
        </div>

        <!-- 5. UFO SUPER CEPAT (Terbang Melintas Layar) -->
        <div class="ufo-container ufo-fast">
            <div class="ufo-icon">🛸</div>
        </div>

        <div class="container position-relative" style="max-width: 1100px; z-index: 2;">

            <!-- HERO SECTION BANNER UTAMA -->
            <div class="hero-card mb-4 animated-card position-relative overflow-hidden">
                <div class="row align-items-center g-3">
                    <div class="col-md-8">
                        <span class="badge bg-warning text-dark fw-bold shadow-sm mb-2">
                            🚀 Media Pembelajaran Interaktif
                        </span>
                        <h1 class="home-hero-title fw-bold mb-3">
                            Belajar Coding Jadi Lebih Seru! 🎮
                        </h1>
                        <p class="home-hero-desc mb-4">
                            Asah logika, selesaikan teka-teki warna, matematika, dan bantu karakter menyelesaikan tantangan!
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ url('/bermain') }}"
                                class="btn btn-warning btn-lg fw-bold shadow">
                                🎮 Mulai Bermain Sekarang!
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 text-center d-none d-md-block">
                        <div class="home-hero-emoji">🧩</div>
                    </div>
                </div>
            </div>

            <!-- SECTION MENGAPA BELAJAR DI EDUGAME ANAK -->
            <div class="main-card p-3 p-md-4 mb-4 animated-card">
                <div class="text-center mb-3">
                    <h2 class="home-section-title fw-bold text-primary">
                        ✨ Mengapa Belajar di EduGame Anak?
                    </h2>
                </div>

                <div class="row g-3 text-center mt-2">
                    <div class="col-md-4">
                        <div class="p-3">
                            <div class="home-feature-icon mb-2">🎯</div>
                            <h4 class="home-feature-title fw-bold text-dark mb-2">Interaktif & Seru</h4>
                            <p class="home-feature-desc text-secondary mb-0">
                                Anak-anak belajar konsep coding dan logika melalui permainan yang menyenangkan.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3">
                            <div class="home-feature-icon mb-2">🧠</div>
                            <h4 class="home-feature-title fw-bold text-dark mb-2">Melatih Logika</h4>
                            <p class="home-feature-desc text-secondary mb-0">
                                Mengasah pemikiran komputasional, pola warna, huruf, dan matematika dasar.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3">
                            <div class="home-feature-icon mb-2">👶</div>
                            <h4 class="home-feature-title fw-bold text-dark mb-2">Ramah Anak</h4>
                            <p class="home-feature-desc text-secondary mb-0">
                                Tampilan visual yang menarik, cerah, dan mudah digunakan oleh anak-anak.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER BAWAH -->
            <div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top border-light text-white-50">
                <div class="fw-bold text-warning home-footer-link">🎮 EduGame Anak</div>
                <a href="{{ url('/tentang') }}" class="text-decoration-none text-white-50 home-footer-link">Tentang Kami</a>
            </div>

        </div>
    </div>
@endsection