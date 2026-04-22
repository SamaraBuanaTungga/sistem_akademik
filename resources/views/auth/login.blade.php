<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Masuk — Sistem Akademik</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <style>
            *, *::before, *::after { box-sizing: border-box; }
            body {
                margin: 0;
                min-height: 100vh;
                display: flex;
                font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
                background: #f4f6f9;
            }

            /* LEFT PANEL */
            .auth-left {
                width: 45%;
                background: #1a2e44;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 48px;
                position: relative;
                overflow: hidden;
            }
            .auth-left::before {
                content: '';
                position: absolute;
                top: -80px; right: -80px;
                width: 300px; height: 300px;
                border-radius: 50%;
                background: rgba(255,255,255,.04);
            }
            .auth-left::after {
                content: '';
                position: absolute;
                bottom: -60px; left: -60px;
                width: 250px; height: 250px;
                border-radius: 50%;
                background: rgba(255,255,255,.04);
            }
            .auth-left-content { position: relative; z-index: 1; text-align: center; }
            .auth-logo {
                width: 64px; height: 64px;
                background: rgba(255,255,255,.12);
                border-radius: 16px;
                display: flex; align-items: center; justify-content: center;
                font-size: 28px;
                margin: 0 auto 20px;
            }
            .auth-brand { color: #fff; font-size: 20px; font-weight: 700; margin-bottom: 6px; }
            .auth-brand-sub { color: rgba(255,255,255,.45); font-size: 13px; margin-bottom: 40px; }
            .auth-features { text-align: left; }
            .auth-feature {
                display: flex; align-items: flex-start; gap: 12px;
                margin-bottom: 20px;
            }
            .auth-feature-icon {
                width: 34px; height: 34px;
                background: rgba(255,255,255,.1);
                border-radius: 9px;
                display: flex; align-items: center; justify-content: center;
                font-size: 14px; color: rgba(255,255,255,.8);
                flex-shrink: 0; margin-top: 1px;
            }
            .auth-feature-title { color: #fff; font-size: 13px; font-weight: 600; }
            .auth-feature-desc  { color: rgba(255,255,255,.45); font-size: 12px; margin-top: 2px; }

            /* RIGHT PANEL */
            .auth-right {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 40px 24px;
            }
            .auth-box {
                width: 100%;
                max-width: 400px;
            }
            .auth-box-title  { font-size: 22px; font-weight: 700; color: #1a202c; margin-bottom: 4px; }
            .auth-box-sub    { font-size: 13px; color: #718096; margin-bottom: 28px; }

            .field-group { margin-bottom: 16px; }
            .field-label {
                display: block;
                font-size: 12.5px; font-weight: 500;
                color: #4a5568; margin-bottom: 6px;
            }
            .field-wrap { position: relative; }
            .field-icon {
                position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
                color: #a0aec0; font-size: 13px; pointer-events: none;
            }
            .field-input {
                width: 100%;
                background: #f7fafc;
                border: 1px solid #e2e8f0;
                border-radius: 9px;
                padding: 10px 13px 10px 38px;
                font-size: 13.5px;
                color: #2d3748;
                font-family: inherit;
                outline: none;
                transition: border-color .15s, background .15s;
            }
            .field-input:focus { border-color: #1a2e44; background: #fff; }
            .field-input.is-invalid { border-color: #e53e3e; }
            .field-error { font-size: 11.5px; color: #e53e3e; margin-top: 5px; }

            .field-toggle {
                position: absolute; right: 13px; top: 50%; transform: translateY(-50%);
                background: none; border: none; cursor: pointer;
                color: #a0aec0; font-size: 13px; padding: 0;
            }
            .field-toggle:hover { color: #718096; }

            .remember-row {
                display: flex; align-items: center; justify-content: space-between;
                margin-bottom: 20px; font-size: 13px;
            }
            .remember-row label { display: flex; align-items: center; gap: 7px; cursor: pointer; color: #4a5568; }
            .remember-row input[type=checkbox] {
                width: 15px; height: 15px; accent-color: #1a2e44; cursor: pointer;
            }
            .forgot-link { color: #2563eb; text-decoration: none; font-size: 12.5px; }
            .forgot-link:hover { text-decoration: underline; }

            .btn-submit {
                width: 100%;
                background: #1a2e44;
                color: #fff;
                border: none;
                border-radius: 9px;
                padding: 11px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                font-family: inherit;
                transition: background .15s;
                display: flex; align-items: center; justify-content: center; gap: 8px;
            }
            .btn-submit:hover { background: #243d59; }

            .divider {
                display: flex; align-items: center; gap: 12px;
                margin: 20px 0; font-size: 12px; color: #a0aec0;
            }
            .divider::before, .divider::after {
                content: ''; flex: 1; height: 1px; background: #e2e8f0;
            }

            .auth-footer { text-align: center; font-size: 13px; color: #718096; margin-top: 20px; }
            .auth-footer a { color: #2563eb; text-decoration: none; font-weight: 500; }
            .auth-footer a:hover { text-decoration: underline; }

            @media (max-width: 768px) {
                .auth-left { display: none; }
                .auth-right { padding: 32px 20px; }
            }
        </style>
    </head>
    <body>
        <div class="auth-left">
            <div class="auth-left-content">
                <div class="auth-logo">🎓</div>
                <div class="auth-brand">Sistem Akademik</div>
                <div class="auth-features">
                    <div class="auth-feature">
                        <div class="auth-feature-icon"><i class="fas fa-building-columns"></i></div>
                        <div>
                            <div class="auth-feature-title">Manajemen Jurusan</div>
                            <div class="auth-feature-desc">Kelola program studi dan akreditasi</div>
                        </div>
                    </div>
                    <div class="auth-feature">
                        <div class="auth-feature-icon"><i class="fas fa-users"></i></div>
                        <div>
                            <div class="auth-feature-title">Data Mahasiswa</div>
                            <div class="auth-feature-desc">Pantau seluruh data mahasiswa aktif</div>
                        </div>
                    </div>
                    <div class="auth-feature">
                        <div class="auth-feature-icon"><i class="fas fa-book-open"></i></div>
                        <div>
                            <div class="auth-feature-title">Matakuliah</div>
                            <div class="auth-feature-desc">Atur kurikulum tiap program studi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="auth-right">
            <div class="auth-box">
                <div class="auth-box-title">Selamat datang</div>
                <div class="auth-box-sub">Masuk ke akun Anda untuk melanjutkan</div>

                @if ($errors->any())
                <div style="background:#fff5f5;border:1px solid #fed7d7;border-radius:9px;padding:11px 14px;margin-bottom:16px;font-size:13px;color:#c53030;">
                    <i class="fas fa-circle-exclamation" style="margin-right:6px"></i>
                    {{ $errors->first() }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="field-group">
                        <label class="field-label">Email</label>
                        <div class="field-wrap">
                            <i class="fas fa-envelope field-icon"></i>
                            <input type="email" name="email" class="field-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                placeholder="contoh@gmail.com" value="{{ old('email') }}" autofocus>
                        </div>
                        @error('email')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label">Password</label>
                        <div class="field-wrap">
                            <i class="fas fa-lock field-icon"></i>
                            <input type="password" name="password" id="password-field"
                                class="field-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="Masukkan password">
                            <button type="button" class="field-toggle" onclick="togglePwd()">
                                <i id="pwd-eye" class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="remember-row">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            Ingat saya
                        </label>
                        @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                        @endif
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-arrow-right-to-bracket"></i> Masuk
                    </button>
                </form>

                @if(Route::has('register'))
                <div class="auth-footer">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>
                @endif
            </div>
        </div>

        <script>
        function togglePwd() {
            const f = document.getElementById('password-field');
            const e = document.getElementById('pwd-eye');
            if (f.type === 'password') {
                f.type = 'text';
                e.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                f.type = 'password';
                e.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
        </script>
    </body>
</html>