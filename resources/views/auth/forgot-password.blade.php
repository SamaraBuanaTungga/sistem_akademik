<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lupa Password — Sistem Akademik</title>
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
            .forgot-icon {
                width: 56px; height: 56px;
                background: rgba(255,255,255,.12);
                border-radius: 50%;
                display: flex; align-items: center; justify-content: center;
                font-size: 22px; margin: 0 auto 14px;
            }
            .auth-card-title { color: #fff; font-size: 17px; font-weight: 700; }
            .auth-card-sub   { color: rgba(255,255,255,.5); font-size: 12.5px; margin-top: 5px; line-height: 1.5; }
            .auth-card-body  { padding: 28px 32px; }

            .status-msg {
                background: #f0fff4; border: 1px solid #c6f6d5;
                border-radius: 9px; padding: 12px 14px;
                font-size: 13px; color: #276749; margin-bottom: 18px;
                display: flex; align-items: flex-start; gap: 8px;
            }
            .field-group { margin-bottom: 18px; }
            .field-label { display: block; font-size: 12.5px; font-weight: 500; color: #4a5568; margin-bottom: 6px; }
            .field-wrap { position: relative; }
            .field-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #a0aec0; font-size: 13px; pointer-events: none; }
            .field-input {
                width: 100%; background: #f7fafc; border: 1px solid #e2e8f0;
                border-radius: 9px; padding: 10px 12px 10px 36px;
                font-size: 13.5px; color: #2d3748;
                font-family: inherit; outline: none; transition: border-color .15s;
            }
            .field-input:focus { border-color: #1a2e44; background: #fff; }
            .field-input.is-invalid { border-color: #e53e3e; }
            .field-error { font-size: 11.5px; color: #e53e3e; margin-top: 5px; }
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
                <div class="forgot-icon">🔑</div>
                <div class="auth-card-title">Lupa Password?</div>
                <div class="auth-card-sub">Masukkan email Anda dan kami akan mengirimkan tautan untuk mereset password</div>
            </div>
            <div class="auth-card-body">
                @if(session('status'))
                <div class="status-msg">
                    <i class="fas fa-circle-check" style="margin-top:1px"></i>
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="field-group">
                        <label class="field-label">Alamat Email</label>
                        <div class="field-wrap">
                            <i class="fas fa-envelope field-icon"></i>
                            <input type="email" name="email"
                                class="field-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                placeholder="contoh@gmail.com"
                                value="{{ old('email') }}" autofocus>
                        </div>
                        @error('email')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Kirim Tautan Reset
                    </button>
                </form>
                <div class="auth-footer">
                    Ingat password? <a href="{{ route('login') }}">Kembali masuk</a>
                </div>
            </div>
        </div>
    </body>
</html>