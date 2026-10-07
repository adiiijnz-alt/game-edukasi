@extends('layouts.app')

@section('content')
    <style>
        /* --- PERBAIKAN NAVBAR HALAMAN TENTANG --- */
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

        /* --- LATAR BELAKANG COSMIC SUNSET/GALAXY UTAMA --- */
        .belajar-section {
            background: linear-gradient(135deg, #1e053a 0%, #3b1578 40%, #a23409 100%);
            min-height: 100vh;
            padding: 35px 15px;
            border-radius: 18px;
            position: relative;
            overflow: hidden;
        }

        /* --- BULAN BERSINAR --- */
        .moon {
            position: absolute;
            top: 28px;
            right: 35px;
            width: 98px;
            height: 98px;
            background: radial-gradient(circle at 35% 35%, #ffffff, #fffde7 40%, #fde047 70%, #eab308 100%);
            border-radius: 50%;
            box-shadow: 0 0 28px rgba(253, 224, 71, 0.9), 0 0 65px rgba(253, 224, 71, 0.5);
            z-index: 1;
            animation: moonGlow 3s ease-in-out infinite alternate;
        }

        @keyframes moonGlow {
            0% {
                box-shadow: 0 0 22px rgba(253, 224, 71, 0.8), 0 0 50px rgba(253, 224, 71, 0.4);
                transform: scale(1);
            }

            100% {
                box-shadow: 0 0 45px rgba(253, 224, 71, 1), 0 0 85px rgba(253, 224, 71, 0.7);
                transform: scale(1.05);
            }
        }

        /* --- ROKET MELUNCUR PAS SAMPAI KE BULAN --- */
        .rocket-fly {
            position: absolute;
            font-size: 4.2rem;
            z-index: 2;
            pointer-events: none;
            filter: drop-shadow(0 0 15px rgba(251, 146, 60, 0.9));
            animation: flyDirectToMoon 8s ease-in-out infinite;
        }

        @keyframes flyDirectToMoon {
            0% {
                bottom: -10%;
                left: -5%;
                transform: rotate(48deg) scale(0.6);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            80% {
                bottom: calc(100% - 95px);
                left: calc(100% - 95px);
                transform: rotate(48deg) scale(1);
                opacity: 1;
            }

            90%,
            100% {
                bottom: calc(100% - 80px);
                left: calc(100% - 80px);
                transform: rotate(48deg) scale(0.1);
                opacity: 0;
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
                radial-gradient(3px 3px at 40px 60px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(4px 4px at 100px 180px, #fde047, rgba(0, 0, 0, 0)),
                radial-gradient(3px 3px at 220px 80px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(4px 4px at 380px 240px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(3px 3px at 520px 110px, #fde047, rgba(0, 0, 0, 0)),
                radial-gradient(5px 5px at 700px 200px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(3px 3px at 850px 90px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(4px 4px at 980px 260px, #fde047, rgba(0, 0, 0, 0));
            background-repeat: repeat;
            background-size: 450px 260px;
            opacity: 0.9;
            animation: twinkle 2.5s ease-in-out infinite alternate;
        }

        @keyframes twinkle {
            0% {
                opacity: 0.5;
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
            animation: shoot 4s linear infinite;
            opacity: 0;
            z-index: 1;
        }

        .shooting-star:nth-child(1) {
            left: 15%;
            animation-delay: 0s;
        }

        .shooting-star:nth-child(2) {
            left: 45%;
            animation-delay: 2.2s;
        }

        .shooting-star:nth-child(3) {
            left: 65%;
            animation-delay: 1s;
        }

        .shooting-star:nth-child(4) {
            left: 85%;
            animation-delay: 3.5s;
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

        /* Kartu Konten Utama Halaman Tentang */
        .main-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            border: 2.5px solid #f97316;
            border-radius: var(--card-radius);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.35);
        }

        .animated-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .animated-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.7rem 2rem rgba(0, 0, 0, .2) !important;
        }

        /* Skala elemen tentang */
        .tentang-title {
            font-size: var(--fs-hero);
            font-family: 'Fredoka One', cursive;
        }

        .tentang-subtitle {
            font-size: var(--fs-body-lg);
        }

        .tentang-card-icon {
            font-size: var(--fs-icon-sm);
        }

        .tentang-card-heading {
            font-size: var(--fs-h3);
        }

        .tentang-card-body {
            font-size: var(--fs-body);
            line-height: 1.6;
        }

        .tentang-feature-icon {
            font-size: var(--fs-icon-md);
        }

        .tentang-feature-title {
            font-size: var(--fs-h5);
        }

        .tentang-feature-desc {
            font-size: var(--fs-body);
            line-height: 1.5;
        }
    </style>

    <!-- CONTAINER UTAMA DENGAN LATAR SAMA SEPERTI MODUL BELAJAR -->
    <div class="belajar-section my-4">
        <!-- Lapisan Bintang & Bulan -->
        <div class="stars-bg"></div>
        <div class="moon"></div>

        <!-- Bintang Jatuh / Meteor -->
        <div class="shooting-star"></div>
        <div class="shooting-star"></div>
        <div class="shooting-star"></div>
        <div class="shooting-star"></div>

        <!-- Roket Terbang Langsung ke Bulan -->
        <div class="rocket-fly">🚀</div>

        <div class="container position-relative" style="max-width: 1000px; z-index: 2;">

            <!-- HEADER JUDUL TENTANG KAMI -->
            <div class="text-center mb-4">
                <span class="badge bg-warning text-dark fw-bold shadow mb-2">Tentang Kami</span>
                <h1 class="tentang-title fw-bold text-white mb-2"
                    style="text-shadow: 0 4px 12px rgba(0,0,0,0.6);">
                    Mengenal EduGame Anak 🌟
                </h1>
                <p class="tentang-subtitle text-white-50 fw-medium mb-0" style="text-shadow: 0 2px 6px rgba(0,0,0,0.6);">
                    Media Pembelajaran Coding & Logika Interaktif untuk Generasi Digital
                </p>
            </div>

            <!-- KARTU 1: VISI & MISI KAMI -->
            <div class="main-card p-3 p-md-4 mb-4 animated-card">
                <div class="d-flex align-items-center mb-3">
                    <span class="tentang-card-icon me-2">🎮</span>
                    <h3 class="tentang-card-heading fw-bold text-dark m-0">Visi & Misi Kami</h3>
                </div>
                <p class="tentang-card-body text-secondary mb-0">
                    EduGame Anak dirancang khusus sebagai jembatan pembelajaran awal bagi anak-anak untuk mengenal dunia
                    logika, matematika, dan dasar pemikiran komputasional (<em>computational thinking</em>) secara
                    menyenangkan dan tanpa tekanan. Kami percaya bahwa setiap anak memiliki potensi logika yang luar biasa
                    jika dikenalkan melalui media visual dan permainan yang interaktif.
                </p>
            </div>

            <!-- KARTU 2: MENGAPA BELAJAR CODING SEJAK DINI? -->
            <div class="main-card p-3 p-md-4 mb-4 animated-card">
                <div class="d-flex align-items-center mb-3">
                    <span class="tentang-card-icon me-2">🚀</span>
                    <h3 class="tentang-card-heading fw-bold text-dark m-0">Mengapa Belajar Coding Sejak Dini?</h3>
                </div>
                <p class="tentang-card-body text-secondary mb-0">
                    Di era digital saat ini, kemampuan pemecahan masalah (<em>problem solving</em>) dan berpikir terstruktur
                    merupakan keterampilan yang sangat krusial. Melalui simulasi permainan yang ada di EduGame Anak,
                    anak-anak belajar menyusun langkah-langkah logis, mengenali pola, membedakan warna & bentuk, serta
                    menyelesaikan perhitungan matematika dasar secara mandiri.
                </p>
            </div>

            <!-- KARTU 3: FITUR UTAMA (3 KOLOM) -->
            <div class="row g-3 text-center mb-4">
                <div class="col-md-4">
                    <div class="main-card p-3 p-md-4 h-100 animated-card">
                        <div class="tentang-feature-icon mb-2">🎨</div>
                        <h5 class="tentang-feature-title fw-bold text-dark mt-2">Huruf & Warna</h5>
                        <p class="tentang-feature-desc text-muted mb-0 mt-1">Melatih visual dan ketelitian anak dalam mengenali pola kata dan warna.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="main-card p-3 p-md-4 h-100 animated-card">
                        <div class="tentang-feature-icon mb-2">🔢</div>
                        <h5 class="tentang-feature-title fw-bold text-dark mt-2">Matematika Dasar</h5>
                        <p class="tentang-feature-desc text-muted mb-0 mt-1">Mengasah kemampuan berhitung melalui angka dan tantangan interaktif.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="main-card p-3 p-md-4 h-100 animated-card">
                        <div class="tentang-feature-icon mb-2">🧩</div>
                        <h5 class="tentang-feature-title fw-bold text-dark mt-2">Logika & Alur</h5>
                        <p class="tentang-feature-desc text-muted mb-0 mt-1">Mengenalkan alur algoritma dan instruksi langkah demi langkah.</p>
                    </div>
                </div>
            </div>

            <!-- FOOTER BAWAH -->
            <div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top border-light text-white-50">
                <div>🎮 EduGame Anak</div>
                <a href="{{ url('/') }}" class="text-decoration-none text-white-50">Beranda</a>
                <div class="fw-bold text-warning">Tentang Kami</div>
            </div>

        </div>
    </div>
@endsection