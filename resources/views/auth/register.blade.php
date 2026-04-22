<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar — Sistem Akademik</title>
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
                background: #fff;
                border: 1px solid #e8ecf0;
                border-radius: 16px;
                width: 100%; max-width: 440px;
                overflow: hidden;
            }
            .auth-card-top {
                background: #1a2e44;
                padding: 28px 32px 24px;
                text-align: center;
            }
            .auth-card-logo {
                width: 48px; height: 48px;
                background: rgba(255,255,255,.12);
                border-radius: 12px;
                display: flex; align-items: center; justify-content: center;
                font-size: 22px; margin: 0 auto 12px;
            }
            .auth-card-title { color: #fff; font-size: 17px; font-weight: 700; }
            .auth-card-sub   { color: rgba(255,255,255,.5); font-size: 12.5px; margin-top: 4px; }
            .auth-card-body  { padding: 28px 32px; }

            .field-group { margin-bottom: 15px; }
            .field-label {
                display: block;
                font-size: 12px; font-weight: 500;
                color: #4a5568; margin-bottom: 5px;
            }
            .field-wrap { position: relative; }
            .field-icon {
                position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
                color: #a0aec0; font-size: 12px; pointer-events: none;
            }
            .field-input {
                width: 100%;
                background: #f7fafc;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                padding: 9px 12px 9px 35px;
                font-size: 13px; color: #2d3748;
                font-family: inherit; outline: none;
                transition: border-color .15s;
            }
            .field-input:focus { border-color: #1a2e44; background: #fff; }
            .field-input.is-invalid { border-color: #e53e3e; }
            .field-error { font-size: 11px; color: #e53e3e; margin-top: 4px; }
            .field-toggle {
                position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
                background: none; border: none; cursor: pointer; color: #a0aec0; font-size: 12px; padding: 0;
            }

            .btn-submit {
                width: 100%; background: #1a2e44; color: #fff;
                border: none; border-radius: 9px; padding: 11px;
                font-size: 14px; font-weight: 600; cursor: pointer;
                font-family: inherit; transition: background .15s;
                display: flex; align-items: center; justify-content: center; gap: 8px;
                margin-top: 4px;
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
                <div class="auth-card-logo">🎓</div>
                <div class="auth-card-title">Buat Akun Baru</div>
                <div class="auth-card-sub">Sistem Akademik</div>
            </div>
            <div class="auth-card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="field-group">
                        <label class="field-label">Nama Lengkap</label>
                        <div class="field-wrap">
                            <i class="fas fa-user field-icon"></i>
                            <input type="text" name="name" class="field-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                placeholder="Nama lengkap Anda" value="{{ old('name') }}" autofocus>
                        </div>
                        @error('name')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label">Email</label>
                        <div class="field-wrap">
                            <i class="fas fa-envelope field-icon"></i>
                            <input type="email" name="email" class="field-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                placeholder="contoh@gmail.com" value="{{ old('email') }}">
                        </div>
                        @error('email')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label">Password</label>
                        <div class="field-wrap">
                            <i class="fas fa-lock field-icon"></i>
                            <input type="password" name="password" id="pwd1"
                                class="field-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="Minimal 8 karakter">
                            <button type="button" class="field-toggle" onclick="togglePwd('pwd1','eye1')">
                                <i id="eye1" class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label">Konfirmasi Password</label>
                        <div class="field-wrap">
                            <i class="fas fa-lock field-icon"></i>
                            <input type="password" name="password_confirmation" id="pwd2"
                                class="field-input" placeholder="Ulangi password">
                            <button type="button" class="field-toggle" onclick="togglePwd('pwd2','eye2')">
                                <i id="eye2" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-user-plus"></i> Daftar Sekarang
                    </button>
                </form>
                <div class="auth-footer">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </div>
        </div>
        <script>
        function togglePwd(id, eyeId) {
            const f = document.getElementById(id);
            const e = document.getElementById(eyeId);
            f.type = f.type === 'password' ? 'text' : 'password';
            e.classList.toggle('fa-eye'); e.classList.toggle('fa-eye-slash');
        }
        </script>
    </body>
</html>