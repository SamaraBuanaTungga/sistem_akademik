<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verifikasi Email — Sistem Akademik UTB</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <style>
            *, *::before, *::after { box-sizing: border-box; }
            body {
                margin: 0; min-height: 100vh;
                display: flex; align-items: center; justify-content: center;
                font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
                background: #f4f6f9; padding: 32px 16px;
            }
            .auth-card {
                background: #fff; border: 1px solid #e8ecf0;
                border-radius: 16px; width: 100%; max-width: 440px; overflow: hidden;
            }
            .auth-card-top {
                background: #1a2e44; padding: 36px 32px; text-align: center;
            }
            .email-anim {
                width: 64px; height: 64px; margin: 0 auto 16px;
                position: relative;
            }
            .email-icon {
                width: 64px; height: 64px;
                background: rgba(255,255,255,.12);
                border-radius: 50%;
                display: flex; align-items: center; justify-content: center;
                font-size: 26px;
            }
            .email-dot {
                position: absolute; top: 4px; right: 4px;
                width: 14px; height: 14px;
                background: #48bb78; border-radius: 50%;
                border: 2px solid #1a2e44;
                animation: pulse-dot 2s ease-in-out infinite;
            }
            @keyframes pulse-dot {
                0%, 100% { transform: scale(1); opacity: 1; }
                50%       { transform: scale(1.2); opacity: .8; }
            }
            .auth-card-title { color: #fff; font-size: 18px; font-weight: 700; }
            .auth-card-sub   { color: rgba(255,255,255,.5); font-size: 12.5px; margin-top: 6px; line-height: 1.6; }

            .auth-card-body { padding: 28px 32px; }

            .info-box {
                background: #ebf8ff; border: 1px solid #bee3f8;
                border-radius: 10px; padding: 14px 16px;
                display: flex; align-items: flex-start; gap: 10px;
                margin-bottom: 22px;
            }
            .info-box i { color: #2b6cb0; font-size: 15px; margin-top: 1px; flex-shrink: 0; }
            .info-box-text { font-size: 13px; color: #2c5282; line-height: 1.55; }
            .info-box-text strong { font-weight: 600; }

            .steps { margin-bottom: 24px; }
            .step {
                display: flex; align-items: flex-start; gap: 12px;
                margin-bottom: 14px;
            }
            .step-num {
                width: 24px; height: 24px; border-radius: 50%;
                background: #1a2e44; color: #fff;
                font-size: 11px; font-weight: 700;
                display: flex; align-items: center; justify-content: center;
                flex-shrink: 0; margin-top: 1px;
            }
            .step-text { font-size: 13px; color: #4a5568; line-height: 1.5; }

            .btn-resend {
                width: 100%; background: #1a2e44; color: #fff;
                border: none; border-radius: 9px; padding: 11px;
                font-size: 14px; font-weight: 600; cursor: pointer;
                font-family: inherit; transition: background .15s;
                display: flex; align-items: center; justify-content: center; gap: 8px;
                margin-bottom: 10px;
            }
            .btn-resend:hover { background: #243d59; }
            .btn-resend:disabled {
                background: #a0aec0; cursor: not-allowed;
            }

            .countdown {
                text-align: center; font-size: 12px; color: #a0aec0;
                margin-bottom: 14px; min-height: 18px;
            }
            .countdown span { color: #2563eb; font-weight: 600; }

            .divider {
                display: flex; align-items: center; gap: 12px;
                margin: 16px 0; font-size: 12px; color: #a0aec0;
            }
            .divider::before, .divider::after {
                content: ''; flex: 1; height: 1px; background: #e2e8f0;
            }

            .btn-logout {
                width: 100%;
                background: #fff; color: #718096;
                border: 1px solid #e2e8f0; border-radius: 9px; padding: 10px;
                font-size: 13px; font-weight: 500; cursor: pointer;
                font-family: inherit; transition: all .15s;
                display: flex; align-items: center; justify-content: center; gap: 8px;
            }
            .btn-logout:hover { background: #f7fafc; color: #4a5568; }
        </style>
    </head>
    <body>
        <div class="auth-card">
            <div class="auth-card-top">
                <div class="email-anim">
                    <div class="email-icon">📧</div>
                    <div class="email-dot"></div>
                </div>
                <div class="auth-card-title">Verifikasi Email Anda</div>
                <div class="auth-card-sub">
                    Kami telah mengirimkan tautan verifikasi ke email Anda.<br>
                    Silakan cek kotak masuk atau folder spam.
                </div>
            </div>

            <div class="auth-card-body">
                @if(session('status') == 'verification-link-sent')
                <div style="background:#f0fff4;border:1px solid #c6f6d5;border-radius:9px;padding:11px 14px;margin-bottom:16px;font-size:13px;color:#276749;display:flex;align-items:center;gap:8px;">
                    <i class="fas fa-circle-check"></i>
                    Tautan verifikasi baru telah dikirim ke email Anda.
                </div>
                @endif

                <div class="info-box">
                    <i class="fas fa-circle-info"></i>
                    <div class="info-box-text">
                        Email dikirim ke <strong>{{ auth()->user()->email }}</strong>.
                        Klik tautan di email tersebut untuk mengaktifkan akun Anda.
                    </div>
                </div>

                <div class="steps">
                    <div class="step">
                        <div class="step-num">1</div>
                        <div class="step-text">Buka aplikasi email atau webmail Anda</div>
                    </div>
                    <div class="step">
                        <div class="step-num">2</div>
                        <div class="step-text">Cari email dari <strong>Sistem Akademik UTB</strong> di kotak masuk atau folder spam</div>
                    </div>
                    <div class="step">
                        <div class="step-num">3</div>
                        <div class="step-text">Klik tombol <strong>"Verifikasi Email"</strong> di dalam email tersebut</div>
                    </div>
                </div>

                <div class="countdown" id="countdown-wrap"></div>

                <form method="POST" action="{{ route('verification.send') }}" id="resend-form">
                    @csrf
                    <button type="submit" class="btn-resend" id="resend-btn">
                        <i class="fas fa-paper-plane"></i> Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <div class="divider">atau</div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-arrow-right-from-bracket"></i> Keluar dari Akun
                    </button>
                </form>
            </div>
        </div>

        <script>
        // Countdown kirim ulang 60 detik setelah klik
        const btn  = document.getElementById('resend-btn');
        const wrap = document.getElementById('countdown-wrap');

        document.getElementById('resend-form').addEventListener('submit', function() {
            startCountdown(60);
        });

        @if(session('status') == 'verification-link-sent')
            startCountdown(60);
        @endif

        function startCountdown(secs) {
            btn.disabled = true;
            let s = secs;
            wrap.innerHTML = 'Kirim ulang tersedia dalam <span>' + s + '</span> detik';
            const t = setInterval(() => {
                s--;
                if (s <= 0) {
                    clearInterval(t);
                    btn.disabled = false;
                    wrap.innerHTML = '';
                } else {
                    wrap.innerHTML = 'Kirim ulang tersedia dalam <span>' + s + '</span> detik';
                }
            }, 1000);
        }
        </script>
    </body>
</html>