@extends('layouts.app')

@section('content')
    <div class="container text-center py-5">
        <div class="mb-4">
            <a href="{{ url('/') }}" class="btn btn-outline-primary btn-sm mb-3">&larr; Kembali ke Beranda</a>
            <h1 class="fw-bold">🚶‍♂️ Tebak Jalan</h1>
            <p class="text-muted">Bantu karakter kita pulang ke rumah dengan aman!</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="p-3 mb-4 rounded-4 shadow-sm bg-white border">
                    <h4 class="mb-0 fw-bold text-primary">Skor: <span id="score">0</span></h4>
                </div>

                <div class="card p-5 shadow-sm border-0 rounded-4 mb-4 bg-white overflow-hidden">
                    <div id="character" style="font-size: 5rem; transition: transform 0.3s;">🚶‍♂️</div>
                    <h4 id="message" class="mt-3 fw-bold text-secondary">Pilih jalan yang benar!</h4>
                </div>

                <div class="d-grid gap-3" id="road-buttons">
                    <button onclick="checkPath(1)" id="btn-1" class="btn btn-primary btn-lg py-3 fw-bold shadow-sm">Jalan
                        Kiri</button>
                    <button onclick="checkPath(2)" id="btn-2" class="btn btn-primary btn-lg py-3 fw-bold shadow-sm">Jalan
                        Tengah</button>
                    <button onclick="checkPath(3)" id="btn-3" class="btn btn-primary btn-lg py-3 fw-bold shadow-sm">Jalan
                        Kanan</button>
                </div>

                <button onclick="resetGame()" id="btn-restart" class="btn btn-warning btn-lg px-5 rounded-pill mt-4 shadow"
                    style="display: none;">Main Lagi 🔄</button>
            </div>
        </div>
    </div>

    <style>
        .btn-correct {
            background-color: #198754 !important;
            border-color: #198754 !important;
            color: white !important;
        }

        .btn-wrong {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
            color: white !important;
        }

        @keyframes walkUp {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-30px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .animasi-jalan {
            animation: walkUp 0.5s ease-in-out;
        }
    </style>

    <script>
        let score = 0;
        let correctPath = Math.floor(Math.random() * 3) + 1;
        let isGameOver = false;

        function checkPath(selected) {
            if (isGameOver) return;
            isGameOver = true;

            const char = document.getElementById('character');
            const msg = document.getElementById('message');
            const scoreDisplay = document.getElementById('score');
            const restartBtn = document.getElementById('btn-restart');

            // Jika Benar
            if (selected === correctPath) {
                score++;
                scoreDisplay.innerText = score;
                msg.innerText = "Selamat! Kamu berhasil pulang 🎉";
                msg.className = "mt-3 fw-bold text-success";
                char.innerText = "🏠🏃‍♂️";
                char.classList.add('animasi-jalan');
                document.getElementById('btn-' + selected).classList.add('btn-correct');
                playSound(440, 880); // Suara benar
            }
            // Jika Salah
            else {
                score = 0;
                scoreDisplay.innerText = score;
                msg.innerText = "Salah jalan! Coba lagi 😢";
                msg.className = "mt-3 fw-bold text-danger";
                char.innerText = "😵‍💫";
                document.getElementById('btn-' + selected).classList.add('btn-wrong');
                document.getElementById('btn-' + correctPath).classList.add('btn-correct'); // Tunjukkan jalan yang benar
                playSound(200, 100); // Suara salah
            }

            restartBtn.style.display = "inline-block";
        }

        function resetGame() {
            correctPath = Math.floor(Math.random() * 3) + 1;
            isGameOver = false;

            document.getElementById('character').innerText = "🚶‍♂️";
            document.getElementById('character').classList.remove('animasi-jalan');
            document.getElementById('message').innerText = "Pilih jalan yang benar!";
            document.getElementById('message').className = "mt-3 fw-bold text-secondary";
            document.getElementById('btn-restart').style.display = "none";

            for (let i = 1; i <= 3; i++) {
                document.getElementById('btn-' + i).className = "btn btn-primary btn-lg py-3 fw-bold shadow-sm";
            }
        }

        // Fungsi Suara Sederhana (Web Audio API)
        function playSound(startFreq, endFreq) {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.frequency.setValueAtTime(startFreq, ctx.currentTime);
            osc.frequency.exponentialRampToValueAtTime(endFreq, ctx.currentTime + 0.2);
            gain.gain.setValueAtTime(0.1, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.2);
            osc.start();
            osc.stop(ctx.currentTime + 0.2);
        }
    </script>
@endsection