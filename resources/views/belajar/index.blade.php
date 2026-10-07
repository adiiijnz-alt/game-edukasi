@extends('layouts.app')

@section('content')
    <style>
        /* 1. MEMBERI WARNA GALAXY/GELAP PADA NAVBAR BAGIAN ATAS */
        nav.navbar,
        .navbar,
        header {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #311042 100%) !important;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        /* Mengubah warna teks menu navbar agar kontras dan terlihat jelas */
        nav.navbar .navbar-brand,
        nav.navbar .nav-link {
            color: #ffffff !important;
            transition: color 0.3s ease;
        }

        nav.navbar .nav-link:hover,
        nav.navbar .nav-link.active {
            color: #fde047 !important;
        }

        nav.navbar .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }

        nav.navbar .navbar-toggler-icon {
            filter: invert(1);
        }

        /* 2. LATAR BELAKANG COSMIC SUNSET/GALAXY UTAMA */
        .belajar-section {
            background: linear-gradient(135deg, #1e053a 0%, #3b1578 40%, #a23409 100%);
            min-height: 100vh;
            padding: 25px 12px;
            border-radius: 16px;
            position: relative;
            overflow: hidden;
        }

        /* --- BULAN BERSINAR --- */
        .moon {
            position: absolute;
            top: 22px;
            right: 25px;
            width: 68px;
            height: 68px;
            background: radial-gradient(circle at 35% 35%, #ffffff, #fffde7 40%, #fde047 70%, #eab308 100%);
            border-radius: 50%;
            box-shadow: 0 0 20px rgba(253, 224, 71, 0.9), 0 0 45px rgba(253, 224, 71, 0.5);
            z-index: 1;
            animation: moonGlow 3s ease-in-out infinite alternate;
        }

        @keyframes moonGlow {
            0% {
                box-shadow: 0 0 16px rgba(253, 224, 71, 0.8), 0 0 35px rgba(253, 224, 71, 0.4);
                transform: scale(1);
            }

            100% {
                box-shadow: 0 0 32px rgba(253, 224, 71, 1), 0 0 60px rgba(253, 224, 71, 0.7);
                transform: scale(1.05);
            }
        }

        /* --- ROKET MELUNCUR PAS SAMPAI KE BULAN --- */
        .rocket-fly {
            position: absolute;
            font-size: 2.95rem;
            z-index: 2;
            pointer-events: none;
            filter: drop-shadow(0 0 10px rgba(251, 146, 60, 0.9));
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
                bottom: calc(100% - 75px);
                left: calc(100% - 75px);
                transform: rotate(48deg) scale(1);
                opacity: 1;
            }

            90%,
            100% {
                bottom: calc(100% - 60px);
                left: calc(100% - 60px);
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

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-6px);
            }
        }

        .floating-icon {
            animation: float 3s ease-in-out infinite;
            display: inline-block;
            font-size: var(--fs-icon-md) !important;
            vertical-align: middle;
        }

        .lang-display-icon {
            font-size: clamp(2.2rem, 3.8vw, 3.2rem);
            line-height: 1;
        }

        .feature-circle-icon {
            width: 52px;
            height: 52px;
            font-size: 1.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        /* Kartu Konten Utama */
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
            box-shadow: 0 0.6rem 1.6rem rgba(0, 0, 0, .12) !important;
        }

        /* Animasi Slide Layar */
        @keyframes slideInLeft {
            0% {
                opacity: 0;
                transform: translateX(-60px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            0% {
                opacity: 0;
                transform: translateX(60px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .slide-left-panel {
            animation: slideInLeft 1s ease-out forwards;
        }

        .slide-right-panel {
            animation: slideInRight 1s ease-out forwards;
        }

        .presentation-screen {
            background: linear-gradient(135deg, #ffffff 0%, #f1f8ff 100%);
            border: 2px solid #0dcaf0;
            border-radius: 12px !important;
            box-shadow: 0 6px 16px rgba(13, 202, 240, 0.12);
            font-size: var(--fs-body) !important;
            line-height: 1.6;
            padding: 1rem !important;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .presentation-screen:hover {
            border-color: #0d6efd;
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.2);
        }
    </style>

    <!-- CONTAINER UTAMA -->
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
        <div class="rocket-fly">🚀</div>        <div class="container position-relative" style="max-width: 950px; z-index: 2;">

            <!-- HEADER JUDUL -->
            <div class="text-center mb-4">
                <h1 class="fw-bold text-warning mb-2"
                    style="font-size: var(--fs-hero); font-family: 'Fredoka One', cursive; text-shadow: 0 4px 12px rgba(0,0,0,0.6);">
                    📖 YUK, BELAJAR BERSAMA! 🛸
                </h1>
                <p class="text-white fw-medium mb-0" style="font-size: var(--fs-body-lg); text-shadow: 0 2px 6px rgba(0,0,0,0.6);">
                    MARI KITA MENGENAL LEBIH DEKAT DUNIA CODING DAN MANFAATNYA!
                </p>
            </div>

            <!-- KARTU UTAMA MODUL -->
            <div class="main-card overflow-hidden shadow mb-4">

                <!-- BAGIAN HEADER BIRU ATAS CARD -->
                <div class="bg-primary py-2 px-3 rounded-top text-center" style="background-color: #2563eb !important;">
                    <h4 style="color: #ffffff !important; font-size: var(--fs-h4); font-weight: bold; margin-bottom: 2px;">
                        🚀 🌐 Kenalan dengan Bahasa Pemrograman! 🌟
                    </h4>
                    <p style="color: #f1f5f9 !important; opacity: 0.95; font-size: var(--fs-small); margin-bottom: 0;">
                        Klik tab di bawah untuk mempelajari kehebatan setiap bahasa coding!
                    </p>
                </div>

                <!-- ISI KARTU / TAB MODUL -->
                <div class="p-3 bg-white">

                    <!-- TAB NAVIGASI -->
                    <ul class="nav nav-pills nav-justified mb-3 gap-2" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-bold rounded-pill border py-1 px-2" id="pills-html-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-html" type="button" role="tab">🌐 HTML</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold rounded-pill border py-1 px-2" id="pills-css-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-css" type="button" role="tab">🎨 CSS</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold rounded-pill border py-1 px-2" id="pills-js-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-js" type="button" role="tab">⚡
                                JavaScript</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold rounded-pill border py-1 px-2" id="pills-php-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-php" type="button" role="tab">🐘 PHP</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold rounded-pill border py-1 px-2" id="pills-python-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-python" type="button" role="tab">🐍
                                Python</button>
                        </li>
                    </ul>

                    <!-- KONTEN TAB -->
                    <div class="tab-content pt-1" id="pills-tabContent">

                        <!-- HTML TAB -->
                        <div class="tab-pane fade show active" id="pills-html" role="tabpanel">
                            <div class="p-3 rounded-3 bg-light border border-2 border-danger">
                                <div class="row align-items-center">
                                    <div class="col-md-3 text-center mb-2 mb-md-0">
                                        <div class="lang-display-icon">🧱</div>
                                        <span class="badge bg-danger rounded-pill mt-1">HTML</span>
                                    </div>
                                    <div class="col-md-9 text-start">
                                        <h4 class="fw-bold text-danger mb-1" style="font-size: var(--fs-h4);">HTML (Rangka Web)</h4>
                                        <p class="text-secondary mb-0" style="font-size: var(--fs-body);">
                                            Ibarat membangun rumah, <strong>HTML</strong> adalah pondasi, tembok, dan
                                            atapnya! HTML bertugas membuat struktur dasar website seperti tulisan, gambar,
                                            tombol, dan form.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CSS TAB -->
                        <div class="tab-pane fade" id="pills-css" role="tabpanel">
                            <div class="p-3 rounded-3 bg-light border border-2 border-primary">
                                <div class="row align-items-center">
                                    <div class="col-md-3 text-center mb-2 mb-md-0">
                                        <div class="lang-display-icon">🎨</div>
                                        <span class="badge bg-primary rounded-pill mt-1">CSS</span>
                                    </div>
                                    <div class="col-md-9 text-start">
                                        <h4 class="fw-bold text-primary mb-1" style="font-size: var(--fs-h4);">CSS (Pewarna & Cat Web)</h4>
                                        <p class="text-secondary mb-0" style="font-size: var(--fs-body);">
                                            Kalau rumah sudah ada temboknya, <strong>CSS</strong> bertugas mengecat tembok,
                                            memilih warna interior, serta mengatur hiasan agar website terlihat cantik,
                                            keren, dan berwarna-warni!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- JAVASCRIPT TAB -->
                        <div class="tab-pane fade" id="pills-js" role="tabpanel">
                            <div class="p-3 rounded-3 bg-light border border-2 border-warning">
                                <div class="row align-items-center">
                                    <div class="col-md-3 text-center mb-2 mb-md-0">
                                        <div class="lang-display-icon">⚡</div>
                                        <span class="badge bg-warning text-dark rounded-pill mt-1">JavaScript</span>
                                    </div>
                                    <div class="col-md-9 text-start">
                                        <h4 class="fw-bold text-dark mb-1" style="font-size: var(--fs-h4);">JavaScript (Otak Interaktif Web)</h4>
                                        <p class="text-secondary mb-0" style="font-size: var(--fs-body);">
                                            <strong>JavaScript</strong> membuat website bergerak dan bisa merespons aksi
                                            pengguna! Seperti saat kamu menekan tombol permainan, membuka animasi lucu, atau
                                            memunculkan skor.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PHP TAB -->
                        <div class="tab-pane fade" id="pills-php" role="tabpanel">
                            <div class="p-3 rounded-3 bg-light border border-2 border-info">
                                <div class="row align-items-center">
                                    <div class="col-md-3 text-center mb-2 mb-md-0">
                                        <div class="lang-display-icon">🐘</div>
                                        <span class="badge bg-info text-dark rounded-pill mt-1">PHP</span>
                                    </div>
                                    <div class="col-md-9 text-start">
                                        <h4 class="fw-bold text-info mb-1" style="font-size: var(--fs-h4);">PHP (Pengelola Dapur Web)</h4>
                                        <p class="text-secondary mb-0" style="font-size: var(--fs-body);">
                                            <strong>PHP</strong> bekerja di balik layar (server). PHP bertugas mengingat
                                            data seperti nama kamu, nilai soal game, serta jawaban yang kamu simpan ke
                                            database.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PYTHON TAB -->
                        <div class="tab-pane fade" id="pills-python" role="tabpanel">
                            <div class="p-3 rounded-3 bg-light border border-2 border-success">
                                <div class="row align-items-center">
                                    <div class="col-md-3 text-center mb-2 mb-md-0">
                                        <div class="lang-display-icon">🐍</div>
                                        <span class="badge bg-success rounded-pill mt-1">Python</span>
                                    </div>
                                    <div class="col-md-9 text-start">
                                        <h4 class="fw-bold text-success mb-1" style="font-size: var(--fs-h4);">Python (Si Serba Bisa)</h4>
                                        <p class="text-secondary mb-0" style="font-size: var(--fs-body);">
                                            <strong>Python</strong> adalah bahasa pemrograman yang paling mudah dibaca dan
                                            dipelajari! Python biasa digunakan untuk membuat Kecerdasan Buatan (AI),
                                            analisis data, dan robotika.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- PENJELASAN MATERI UTAMA -->
            <div class="card p-3 p-md-4 shadow-sm border-0 rounded-4 mb-4 bg-light text-center">

                <div class="slide-left-panel mb-4">
                    <h2 class="text-primary fw-bold mb-3" style="font-size: var(--fs-h2);">
                        <span class="floating-icon me-2">✨</span> APA ITU CODING?
                    </h2>
                    <div class="presentation-screen text-dark text-start p-3 rounded-3">
                        <p><strong>Coding</strong> adalah cara kita memberikan <em>perintah</em> atau instruksi kepada
                            komputer agar bisa melakukan sesuatu yang kita inginkan, seperti menyusun huruf, berhitung, atau
                            bahkan menggerakkan karakter di dalam game.</p>

                        <p class="mb-0">Sama seperti saat kita berbicara kepada teman atau orang tua menggunakan bahasa yang
                            dimengerti, komputer juga punya "bahasa" sendiri. Belajar coding itu seperti bermain menyusun
                            petunjuk jalan atau bermain puzzle!</p>
                    </div>
                </div>

                <hr class="my-4 opacity-25">

                <div class="slide-right-panel mb-4">
                    <h2 class="text-info fw-bold mb-3" style="font-size: var(--fs-h2);">
                        <span class="floating-icon me-2" style="animation-delay: 1s;">🚂</span> APA ITU ALGORITMA?
                    </h2>
                    <div class="presentation-screen text-dark text-start p-3 rounded-3">
                        <p><strong>Algoritma</strong> adalah urutan langkah-langkah yang kita lakukan untuk menyelesaikan
                            suatu masalah. Misalnya, saat kamu ingin memakai sepatu, pasti ada urutannya, bukan?</p>
                        <ol class="mt-2 ps-3 fw-medium">
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Ambil kaus kaki dan pakai di kaki.
                            </li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Ambil sepatu yang ingin dipakai.
                            </li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Pasang tali sepatu dan ikat dengan
                                rapi.</li>
                        </ol>
                        <p class="mt-2 mb-0">Komputer juga butuh langkah-langkah seperti ini agar tidak bingung. Di game
                            <em>Coding Huruf & Warna</em>, kamu menyusun warna agar komputer tahu huruf apa yang harus
                            ditampilkan!
                        </p>
                    </div>
                </div>

                <hr class="my-4 opacity-25">

                <h3 class="text-success fw-bold mb-3" style="font-size: var(--fs-h3);">
                    <span class="floating-icon me-2" style="animation-delay: 0.5s;">🌟</span> MANFAAT BERMAIN GAME
                    EDUKASI INI
                </h3>
                <div class="row g-3 text-start mt-2">

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm p-3 rounded-3 animated-card bg-white">
                            <div class="feature-circle-icon bg-danger bg-opacity-10 mb-2">🎨</div>
                            <h5 class="fw-bold text-dark mt-1" style="font-size: var(--fs-h5);">CODING HURUF & WARNA</h5>
                            <p class="text-muted small mb-0 mt-1 lh-base" style="font-size: var(--fs-small);">Melatih ketelitian, memecahkan pola rahasia, serta
                                membantu membaca kata dengan cepat dan menyenangkan.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm p-3 rounded-3 animated-card bg-white">
                            <div class="feature-circle-icon bg-success bg-opacity-10 mb-2">🧮</div>
                            <h5 class="fw-bold text-dark mt-1" style="font-size: var(--fs-h5);">CODING MATEMATIKA</h5>
                            <p class="text-muted small mb-0 mt-1 lh-base" style="font-size: var(--fs-small);">Mengasah kemampuan berhitung dasar dengan cepat
                                dan melatih otak agar terbiasa berpikir logis.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm p-3 rounded-3 animated-card bg-white">
                            <div class="feature-circle-icon bg-warning bg-opacity-10 mb-2">🕹</div>
                            <h5 class="fw-bold text-dark mt-1" style="font-size: var(--fs-h5);">TEBAK YUK!</h5>
                            <p class="text-muted small mb-0 mt-1 lh-base" style="font-size: var(--fs-small);">Memperkaya kosakata bahasa Inggris sehari-hari
                                serta mempertajam daya ingat dan imajinasi.</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- TOMBOL NAVIGASI -->
            <div class="text-center">
                <a href="{{ url('/') }}"
                    class="btn btn-warning btn-lg rounded-pill px-4 py-2 fw-bold text-dark shadow animated-card">
                    &larr; KEMBALI KE BERANDA UNTUK BERMAIN
                </a>
            </div>

            <div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top border-light text-white-50">
                <div>🎮 EduGame Anak</div>
                <a href="{{ url('/') }}" class="text-decoration-none text-white-50">Beranda</a>
                <div class="fw-bold text-warning">Modul Belajar</div>
            </div>
        </div>
    </div>
@endsection