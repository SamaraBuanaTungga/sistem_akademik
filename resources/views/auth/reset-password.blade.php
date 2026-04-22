<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password — Sistem Akademik</title>
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
                background: rgba(255,255,255,.12);
                border-radius: 50%;
                display: flex; align-items: center; justify-content: center;
                font-size: 22px; margin: 0 auto 14px;
            }
            .auth-card-title { color: #fff; font-size: 17px; font-weight: 700; }
            .auth-card-sub   { color: rgba(255,255,255,.5); font-size: 12.5px; margin-top: 5px; line-height: 1.5; }
            .auth-card-body  { padding: 28px 32px; }

            .field-group { margin-bottom: 15px; }
            .field-label { display: block; font-size: 12.5px; font-weight: 500; color: #4a5568; margin-bottom: 6px; }
            .field-wrap  { position: relative; }
            .field-icon  {
                position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
                color: #a0aec0; font-size: 13px; pointer-events: none;
            }
            .field-input {
                width: 100%; background: #f7fafc; border: 1px solid #e2e8f0;
                border-radius: 9px; padding: 10px 12px 10px 36px;
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

            .pwd-strength { margin-top: 7px; }
            .pwd-strength-bars { display: flex; gap: 4px; margin-bottom: 4px; }
            .pwd-bar {
                flex: 1; height: 4px; border-radius: 99px;
                background: #e2e8f0; transition: background .2s;
            }
            .pwd-bar.weak   { background: #e53e3e; }
            .pwd-bar.medium { background: #ed8936; }
            .pwd-bar.strong { background: #38a169; }
            .pwd-strength-label { font-size: 11px; color: #a0aec0; }

            .btn-submit {
                width: 100%; background: #1a2e44; color: #fff;
                border: none; border-radius: 9px; padding: 11px;
                font-size: 14px; font-weight: 600; cursor: pointer;
                font-family: inherit; transition: background .15s;
                display: flex; align-items: center; justify-content: center; gap: 8px;
                margin-top: 6px;
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
                <div class="top-icon">🔒</div>
                <div class="auth-card-title">Buat Password Baru</div>
                <div class="auth-card-sub">Password baru harus berbeda dari password yang pernah digunakan sebelumnya</div>
            </div>
            <div class="auth-card-body">

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="field-group">
                        <label class="field-label">Email</label>
                        <div class="field-wrap">
                            <i class="fas fa-envelope field-icon"></i>
                            <input type="email" name="email"
                                class="field-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                placeholder="contoh@utb.ac.id"
                                value="{{ old('email', $request->email) }}" autofocus>
                        </div>
                        @error('email')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Password Baru</label>
                        <div class="field-wrap">
                            <i class="fas fa-lock field-icon"></i>
                            <input type="password" name="password" id="pwd-new"
                                class="field-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="Minimal 8 karakter"
                                oninput="checkStrength(this.value)">
                            <button type="button" class="field-toggle" onclick="togglePwd('pwd-new','eye-new')">
                                <i id="eye-new" class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="pwd-strength">
                            <div class="pwd-strength-bars">
                                <div class="pwd-bar" id="bar1"></div>
                                <div class="pwd-bar" id="bar2"></div>
                                <div class="pwd-bar" id="bar3"></div>
                                <div class="pwd-bar" id="bar4"></div>
                            </div>
                            <div class="pwd-strength-label" id="strength-label">Masukkan password</div>
                        </div>
                        @error('password')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Konfirmasi Password Baru</label>
                        <div class="field-wrap">
                            <i class="fas fa-lock field-icon"></i>
                            <input type="password" name="password_confirmation" id="pwd-confirm"
                                class="field-input"
                                placeholder="Ulangi password baru">
                            <button type="button" class="field-toggle" onclick="togglePwd('pwd-confirm','eye-confirm')">
                                <i id="eye-confirm" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-floppy-disk"></i> Simpan Password Baru
                    </button>
                </form>

                <div class="auth-footer">
                    <a href="{{ route('login') }}"><i class="fas fa-arrow-left" style="font-size:11px;margin-right:4px"></i>Kembali ke halaman masuk</a>
                </div>
            </div>
        </div>

        <script>
        function togglePwd(id, eyeId) {
            const f = document.getElementById(id);
            const e = document.getElementById(eyeId);
            f.type = f.type === 'password' ? 'text' : 'password';
            e.classList.toggle('fa-eye');
            e.classList.toggle('fa-eye-slash');
        }

        function checkStrength(val) {
            const bars   = [bar1, bar2, bar3, bar4];
            const label  = document.getElementById('strength-label');
            const colors = { weak: '#e53e3e', medium: '#ed8936', strong: '#38a169' };

            bars.forEach(b => { b.style.background = '#e2e8f0'; });

            if (!val) { label.textContent = 'Masukkan password'; label.style.color = '#a0aec0'; return; }

            let score = 0;
            if (val.length >= 8)              score++;
            if (/[A-Z]/.test(val))            score++;
            if (/[0-9]/.test(val))            score++;
            if (/[^A-Za-z0-9]/.test(val))     score++;

            const levels = [
                { n: 1, color: colors.weak,   text: 'Lemah',   label: '#e53e3e' },
                { n: 2, color: colors.medium, text: 'Cukup',   label: '#ed8936' },
                { n: 3, color: colors.medium, text: 'Sedang',  label: '#ed8936' },
                { n: 4, color: colors.strong, text: 'Kuat',    label: '#38a169' },
            ];
            const lv = levels[score - 1] || levels[0];
            for (let i = 0; i < score; i++) bars[i].style.background = lv.color;
            label.textContent  = lv.text;
            label.style.color  = lv.label;
        }
        </script>
    </body>
</html>