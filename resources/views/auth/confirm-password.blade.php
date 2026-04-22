<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Konfirmasi Password — Sistem Akademik UTB</title>
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
                border-radius: 16px; width: 100%; max-width: 420px; overflow: hidden;
            }
            .auth-card-top {
                background: #1a2e44; padding: 32px; text-align: center;
            }
            .top-icon {
                width: 56px; height: 56px;
                background: rgba(255,255,255,.12); border-radius: 50%;
                display: flex; align-items: center; justify-content: center;
                font-size: 24px; margin: 0 auto 14px;
            }
            .auth-card-title { color: #fff; font-size: 17px; font-weight: 700; }
            .auth-card-sub {
                color: rgba(255,255,255,.5); font-size: 12.5px;
                margin-top: 6px; line-height: 1.6;
            }
            .auth-card-body { padding: 28px 32px; }

            .secure-banner {
                display: flex; align-items: center; gap: 10px;
                background: #fffbeb; border: 1px solid #fde68a;
                border-radius: 9px; padding: 12px 14px; margin-bottom: 20px;
                font-size: 13px; color: #92400e;
            }
            .secure-banner i { font-size: 15px; color: #d97706; flex-shrink: 0; }

            .field-group { margin-bottom: 18px; }
            .field-label { display: block; font-size: 12.5px; font-weight: 500; color: #4a5568; margin-bottom: 6px; }
            .field-wrap { position: relative; }
            .field-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #a0aec0; font-size: 13px; pointer-events: none; }
            .field-input {
                width: 100%; background: #f7fafc; border: 1px solid #e2e8f0;
                border-radius: 9px; padding: 10px 40px 10px 36px;
                font-size: 13.5px; color: #2d3748;
                font-family: inherit; outline: none; transition: border-color .15s;
            }
            .field-input:focus { border-color: #1a2e44; background: #fff; }
            .field-input.is-invalid { border-color: #e53e3e; }
            .field-error { font-size: 11.5px; color: #e53e3e; margin-top: 5px; }
            .field-toggle {
                position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
                background: none; border: none; cursor: pointer;
                color: #a0aec0; font-size: 13px; padding: 0;
            }
            .field-toggle:hover { color: #718096; }

            .btn-submit {
                width: 100%; background: #1a2e44; color: #fff;
                border: none; border-radius: 9px; padding: 11px;
                font-size: 14px; font-weight: 600; cursor: pointer;
                font-family: inherit; transition: background .15s;
                display: flex; align-items: center; justify-content: center; gap: 8px;
            }
            .btn-submit:hover { background: #243d59; }
            .auth-footer { text-align: center; font-size: 13px; color: #718096; margin-top: 18px; }
            .auth-footer a { color: #2563eb; text-decoration: none; font-weight: 500; }
            .auth-footer a:hover { text-decoration: underline; }
        </style>
    </head>
    <body>
        <div class="auth-card">
            <div class="auth-card-top">
                <div class="top-icon">🛡️</div>
                <div class="auth-card-title">Konfirmasi Identitas</div>
                <div class="auth-card-sub">
                    Area ini membutuhkan konfirmasi keamanan tambahan.<br>
                    Masukkan password Anda untuk melanjutkan.
                </div>
            </div>
            <div class="auth-card-body">
                <div class="secure-banner">
                    <i class="fas fa-triangle-exclamation"></i>
                    Sesi Anda memerlukan verifikasi ulang untuk mengakses halaman ini.
                </div>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div class="field-group">
                        <label class="field-label">Password</label>
                        <div class="field-wrap">
                            <i class="fas fa-lock field-icon"></i>
                            <input type="password" name="password" id="pwd-confirm"
                                class="field-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="Masukkan password Anda" autofocus>
                            <button type="button" class="field-toggle" onclick="togglePwd()">
                                <i id="pwd-eye" class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-shield-halved"></i> Konfirmasi & Lanjutkan
                    </button>
                </form>

                <div class="auth-footer">
                    <a href="{{ route('login') }}">
                        <i class="fas fa-arrow-left" style="font-size:11px;margin-right:4px"></i>
                        Kembali ke halaman masuk
                    </a>
                </div>
            </div>
        </div>
        <script>
        function togglePwd() {
            const f = document.getElementById('pwd-confirm');
            const e = document.getElementById('pwd-eye');
            f.type = f.type === 'password' ? 'text' : 'password';
            e.classList.toggle('fa-eye');
            e.classList.toggle('fa-eye-slash');
        }
        </script>
    </body>
</html>