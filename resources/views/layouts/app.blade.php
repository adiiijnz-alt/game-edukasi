<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Edukasi - Belajar Coding itu Seru!</title>

    <!-- Bootstrap 5 & Font Google -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- CDN Unpoly (Mencegah Reload Halaman Agar Musik Terus Menyala) -->
    <script src="https://cdn.jsdelivr.net/npm/unpoly@3.8.0/unpoly.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/unpoly@3.8.0/unpoly.min.css">

    <style>
        /* ============================================
           GLOBAL DESIGN SYSTEM - UI SCALE VARIABLES
           (Skala Menengah Proporsional: ~70% dari versi besar)
           ============================================ */
        :root {
            /* Typography Scale */
            --fs-hero:        clamp(1.3rem,  2.5vw, 1.9rem);
            --fs-h1:          clamp(1.15rem, 2vw,   1.55rem);
            --fs-h2:          clamp(1rem,    1.6vw, 1.25rem);
            --fs-h3:          clamp(0.92rem, 1.3vw, 1.1rem);
            --fs-h4:          clamp(0.85rem, 1.1vw, 0.98rem);
            --fs-h5:          clamp(0.8rem,  1vw,   0.9rem);
            --fs-body-lg:     clamp(0.88rem, 1.1vw, 0.96rem);
            --fs-body:        clamp(0.82rem, 1vw,   0.9rem);
            --fs-small:       clamp(0.72rem, 0.85vw,0.8rem);
            --fs-label:       clamp(0.8rem,  0.95vw,0.88rem);
            --fs-btn:         clamp(0.82rem, 1vw,   0.92rem);
            --fs-input:       clamp(0.85rem, 1.1vw, 0.95rem);
            --fs-icon-sm:     clamp(0.95rem, 1.6vw, 1.3rem);
            --fs-icon-md:     clamp(1.3rem,  2vw,   1.8rem);
            --fs-icon-lg:     clamp(2rem,    3vw,   3.2rem);
            --fs-icon-xl:     clamp(2.5rem,  4vw,   4.4rem);

            /* Spacing Scale */
            --gap-xs:   0.3rem;
            --gap-sm:   0.5rem;
            --gap-md:   0.75rem;
            --gap-lg:   1.1rem;
            --gap-xl:   1.5rem;

            /* Container */
            --card-radius:    16px;
            --card-pad-x:     clamp(0.8rem, 2vw, 1.75rem);
            --card-pad-y:     clamp(0.8rem, 2vw, 1.5rem);

            /* Button */
            --btn-pad-x:      clamp(0.8rem, 1.5vw, 1.5rem);
            --btn-pad-y:      clamp(0.4rem, 0.7vw, 0.52rem);
            --btn-radius:     26px;
        }

        html,
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #120b29;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-size: var(--fs-body);
            overflow-x: hidden;
            width: 100%;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Fredoka One', cursive;
        }

        /* ---- GLOBAL NAVBAR SCALE ---- */
        .navbar {
            padding-top: 0.45rem !important;
            padding-bottom: 0.45rem !important;
        }

        .navbar-brand {
            font-size: clamp(0.88rem, 1.2vw, 1.05rem) !important;
            gap: 0.3rem;
        }

        .navbar-brand span {
            font-size: clamp(0.95rem, 1.3vw, 1.15rem);
        }

        .nav-link {
            font-size: clamp(0.8rem, 0.95vw, 0.88rem) !important;
            font-weight: 600;
            padding: 0.25rem 0.2rem !important;
        }

        .navbar-toggler {
            padding: 0.28rem 0.45rem;
        }

        /* ---- GLOBAL FOOTER SCALE ---- */
        footer {
            font-size: var(--fs-body) !important;
            padding: 0.75rem 0.5rem !important;
        }

        /* ---- GLOBAL BUTTON SCALE ---- */
        .btn {
            font-size: var(--fs-btn) !important;
            font-weight: 700;
            padding: var(--btn-pad-y) var(--btn-pad-x) !important;
            border-radius: var(--btn-radius) !important;
        }

        .btn-sm {
            font-size: calc(var(--fs-btn) * 0.85) !important;
            padding: calc(var(--btn-pad-y) * 0.75) calc(var(--btn-pad-x) * 0.75) !important;
        }

        .btn-lg {
            font-size: clamp(0.85rem, 1.1vw, 0.98rem) !important;
            padding: calc(var(--btn-pad-y) * 1.15) calc(var(--btn-pad-x) * 1.2) !important;
        }

        /* ---- GLOBAL ALERT SCALE ---- */
        .alert {
            font-size: var(--fs-body) !important;
            padding: 0.55rem 0.85rem !important;
            border-radius: 10px !important;
        }

        /* ---- GLOBAL INPUT / FORM SCALE ---- */
        .form-control,
        .form-control-lg {
            font-size: var(--fs-input) !important;
            padding: 0.42rem 0.65rem !important;
            border-radius: 10px !important;
            min-height: 34px;
        }

        /* ---- BGM BUTTON FLOAT ---- */
        .btn-bgm-float {
            position: fixed !important;
            bottom: 14px !important;
            right: 14px !important;
            z-index: 999999 !important;
            pointer-events: auto !important;
            cursor: pointer !important;
            border-radius: 26px;
            padding: 6px 12px;
            font-size: 0.75rem;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            transition: transform 0.2s ease;
        }

        .btn-bgm-float:hover {
            transform: scale(1.05);
        }

        /* ---- BADGE SCALE ---- */
        .badge {
            font-size: clamp(0.65rem, 0.85vw, 0.75rem) !important;
            padding: 0.3em 0.6em !important;
        }

        /* ---- TABLE SCALE ---- */
        table th,
        table td {
            font-size: var(--fs-body) !important;
            padding: 0.4rem 0.35rem !important;
        }

        /* ---- NAV PILLS SCALE ---- */
        .nav-pills .nav-link,
        .nav-tabs .nav-link {
            font-size: var(--fs-label) !important;
            padding: 0.35rem 0.65rem !important;
            font-weight: 700;
        }

        /* ---- RESPONSIVE MOBILE ADJUSTMENTS ---- */
        @media (max-width: 576px) {
            .btn-bgm-float {
                bottom: 10px !important;
                right: 10px !important;
                padding: 5px 9px;
                font-size: 0.7rem;
            }

            .container {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar Global -->
    <nav class="navbar navbar-expand-lg navbar-dark"
        style="background-color: #181931 !important; border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-white" href="{{ url('/') }}">
                <span>🎮</span> EduGame Anak
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active fw-bold text-warning' : 'text-white-50' }}"
                            href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('belajar*') || request()->is('modul*') ? 'active fw-bold text-warning' : 'text-white-50' }}"
                            href="{{ route('belajar.index') }}">Modul Belajar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tentang*') ? 'active fw-bold text-warning' : 'text-white-50' }}"
                            href="{{ route('tentang') }}">Tentang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-shrink-0 flex-grow-1">
        @yield('content')
    </main>

    <!-- Global Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-auto border-top border-secondary border-opacity-25">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} EduGame Anak. Ciptakan Masa Depan Digital.</p>
        </div>
    </footer>

    <!-- AUDIO BACKSOUND GLOBAL -->
    <audio id="global-bgm" loop preload="auto">
        <source src="{{ asset('audio/bgm.mpeg') }}" type="audio/mpeg">
        <source src="{{ asset('audio/bgm.mp3') }}" type="audio/mpeg">
    </audio>

    <!-- TOMBOL MUSIK MELAYANG -->
    <button id="btn-toggle-bgm" type="button" onclick="toggleGlobalBGM()" class="btn btn-success btn-bgm-float">
        🎵 Musik: ON
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const bgm = document.getElementById('global-bgm');
        const btnBgm = document.getElementById('btn-toggle-bgm');

        if (bgm && btnBgm) {
            bgm.volume = 0.2; // Set volume 20%

            function updateButtonUI(isPlaying) {
                if (isPlaying) {
                    btnBgm.innerHTML = "🎵 Musik: ON";
                    btnBgm.classList.remove('btn-warning');
                    btnBgm.classList.add('btn-success');
                } else {
                    btnBgm.innerHTML = "🔇 Musik: OFF";
                    btnBgm.classList.remove('btn-success');
                    btnBgm.classList.add('btn-warning');
                }
            }

            function playBGM() {
                bgm.play().then(() => {
                    updateButtonUI(true);
                }).catch(err => {
                    console.log("Autoplay ditahan browser, menunggu interaksi pengguna.");
                });
            }

            // Putar audio secara otomatis jika pengguna tidak menonaktifkan musik sebelumnya
            if (localStorage.getItem('bgm_disabled') !== 'true') {
                playBGM();
            } else {
                updateButtonUI(false);
            }

            // Memicu pemutaran musik saat ada klik pertama jika diblokir oleh browser
            document.addEventListener('click', function startBgmOnce() {
                if (bgm.paused && localStorage.getItem('bgm_disabled') !== 'true') {
                    playBGM();
                }
            }, { once: true });

            window.toggleGlobalBGM = function () {
                if (bgm.paused) {
                    playBGM();
                    localStorage.removeItem('bgm_disabled');
                } else {
                    bgm.pause();
                    localStorage.setItem('bgm_disabled', 'true');
                    updateButtonUI(false);
                }
            };

            // Menjaga status UI tombol tetap konsisten saat berpindah halaman via Unpoly
            document.addEventListener('up:fragment:loaded', function () {
                updateButtonUI(!bgm.paused);
            });
        }
    </script>
</body>

</html>