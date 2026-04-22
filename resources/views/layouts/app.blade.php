<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Akademik')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --navy: #1a2e44;
            --navy-light: #243d59;
            --sidebar-w: 230px;
        }
        *, *::before, *::after { box-sizing: border-box; }
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            font-size: 14px;
            color: #2d3748;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--navy);
            display: flex;
            flex-direction: column;
            z-index: 1040;
            transition: transform .25s ease;
        }
        .sidebar-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .brand-logo {
            width: 46px; height: 46px;
            background: rgba(255,255,255,.1);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 10px;
            font-size: 20px;
        }
        .brand-title {
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            line-height: 1.4;
        }
        .brand-subtitle {
            color: rgba(255,255,255,.4);
            font-size: 11px;
            margin-top: 2px;
        }

        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
        .nav-section-label {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: rgba(255,255,255,.28);
            padding: 12px 10px 5px;
        }
        .nav-link-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 11px;
            border-radius: 8px;
            color: rgba(255,255,255,.6);
            font-size: 13px;
            text-decoration: none;
            transition: all .15s;
            margin-bottom: 2px;
        }
        .nav-link-item i {
            width: 18px;
            text-align: center;
            font-size: 13px;
        }
        .nav-link-item:hover {
            background: rgba(255,255,255,.08);
            color: rgba(255,255,255,.9);
        }
        .nav-link-item.active {
            background: rgba(255,255,255,.14);
            color: #fff;
            font-weight: 500;
        }
        .nav-link-item.active i { opacity: 1; }

        .sidebar-footer {
            padding: 12px;
            border-top: 1px solid rgba(255,255,255,.07);
        }
        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 9px;
            cursor: pointer;
            transition: background .15s;
        }
        .user-card:hover { background: rgba(255,255,255,.07); }
        .user-avatar {
            width: 32px; height: 32px;
            background: rgba(255,255,255,.15);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px;
            color: #fff;
            font-weight: 600;
            flex-shrink: 0;
        }
        .user-name { color: rgba(255,255,255,.8); font-size: 12.5px; font-weight: 500; }
        .user-email { color: rgba(255,255,255,.35); font-size: 10.5px; }
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 8px;
            color: rgba(255,255,255,.45);
            font-size: 12px;
            text-decoration: none;
            transition: all .15s;
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
            margin-top: 4px;
        }
        .logout-btn:hover {
            background: rgba(220,50,50,.15);
            color: #fc8181;
        }

        /* ── TOPBAR ── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: 56px;
            background: #fff;
            border-bottom: 1px solid #e8ecf0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 1030;
        }
        .topbar-left { display: flex; align-items: center; gap: 12px; }
        .topbar-hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            color: #4a5568;
        }
        .page-title { font-size: 15px; font-weight: 600; color: #1a202c; }
        .breadcrumb-text { font-size: 12px; color: #a0aec0; }
        .breadcrumb-text span { color: #4a5568; }

        .topbar-right { display: flex; align-items: center; gap: 8px; }
        .status-pill {
            display: flex; align-items: center; gap: 5px;
            background: #f7fafc;
            border: 1px solid #e8ecf0;
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 12px;
            color: #718096;
        }
        .status-dot {
            width: 7px; height: 7px;
            background: #48bb78;
            border-radius: 50%;
        }
        .topbar-icon-btn {
            width: 36px; height: 36px;
            background: #f7fafc;
            border: 1px solid #e8ecf0;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            color: #718096;
            cursor: pointer;
            font-size: 13px;
        }

        /* ── MAIN CONTENT ── */
        .main-wrap {
            margin-left: var(--sidebar-w);
            padding-top: 56px;
            min-height: 100vh;
        }
        .page-content { padding: 22px 24px; }

        /* ── ALERTS ── */
        .alert-custom {
            display: flex; align-items: center; gap: 10px;
            background: #f0fff4;
            border: 1px solid #c6f6d5;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 18px;
            font-size: 13px;
            color: #276749;
        }
        .alert-custom i { color: #48bb78; font-size: 15px; }
        .alert-close {
            margin-left: auto;
            background: none; border: none;
            color: #a0aec0; cursor: pointer; font-size: 16px; line-height: 1;
        }

        /* ── STAT CARDS ── */
        .stat-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 20px; }
        .stat-card {
            background: #fff;
            border: 1px solid #e8ecf0;
            border-radius: 12px;
            padding: 18px 20px;
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            border-radius: 12px 12px 0 0;
        }
        .stat-card.navy::before  { background: var(--navy); }
        .stat-card.green::before { background: #38a169; }
        .stat-card.red::before   { background: #e53e3e; }
        .stat-icon-wrap {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
            margin-bottom: 12px;
        }
        .stat-card.navy  .stat-icon-wrap { background: #ebf0f5; color: var(--navy); }
        .stat-card.green .stat-icon-wrap { background: #f0fff4; color: #38a169; }
        .stat-card.red   .stat-icon-wrap { background: #fff5f5; color: #e53e3e; }
        .stat-label { font-size: 12px; color: #718096; margin-bottom: 4px; }
        .stat-value { font-size: 28px; font-weight: 700; color: #1a202c; line-height: 1; }
        .stat-desc  { font-size: 11px; color: #a0aec0; margin-top: 6px; }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex; align-items: flex-start; justify-content: space-between;
            margin-bottom: 18px;
        }
        .page-header-title { font-size: 16px; font-weight: 600; color: #1a202c; }
        .page-header-sub { font-size: 12px; color: #a0aec0; margin-top: 2px; }
        .btn-primary-custom {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 9px;
            padding: 9px 16px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: background .15s;
            font-family: inherit;
        }
        .btn-primary-custom:hover { background: var(--navy-light); color: #fff; }
        .btn-secondary-custom {
            display: inline-flex; align-items: center; gap: 7px;
            background: #fff;
            color: #4a5568;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            padding: 9px 16px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all .15s;
            font-family: inherit;
        }
        .btn-secondary-custom:hover { background: #f7fafc; color: #2d3748; }

        /* ── TABLE CARD ── */
        .table-card {
            background: #fff;
            border: 1px solid #e8ecf0;
            border-radius: 12px;
            overflow: hidden;
        }
        .table-toolbar {
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 10px;
            padding: 14px 18px;
            border-bottom: 1px solid #f0f4f8;
        }
        .table-toolbar-title { font-size: 13px; font-weight: 600; color: #2d3748; }
        .search-input-wrap {
            position: relative;
            display: flex; align-items: center;
        }
        .search-input-wrap i {
            position: absolute; left: 11px;
            color: #a0aec0; font-size: 12px;
        }
        .search-input {
            background: #f7fafc;
            border: 1px solid #e8ecf0;
            border-radius: 8px;
            padding: 7px 12px 7px 30px;
            font-size: 13px;
            color: #4a5568;
            width: 220px;
            outline: none;
            font-family: inherit;
            transition: border-color .15s;
        }
        .search-input:focus { border-color: #a0aec0; background: #fff; }

        .data-table { width: 100%; border-collapse: collapse; }
        .data-table thead tr {
            background: #f7fafc;
            border-bottom: 1px solid #e8ecf0;
        }
        .data-table thead th {
            padding: 10px 18px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #718096;
            text-align: left;
            white-space: nowrap;
        }
        .data-table tbody tr {
            border-bottom: 1px solid #f0f4f8;
            transition: background .1s;
        }
        .data-table tbody tr:last-child { border: none; }
        .data-table tbody tr:hover { background: #fafbfd; }
        .data-table tbody td {
            padding: 11px 18px;
            font-size: 13px;
            color: #2d3748;
        }
        .no-num { color: #a0aec0; font-size: 12px; }

        .nim-tag {
            display: inline-block;
            font-family: 'Courier New', monospace;
            font-size: 11.5px;
            background: #edf2f7;
            color: #4a5568;
            border-radius: 5px;
            padding: 2px 8px;
        }
        .sks-tag {
            display: inline-block;
            background: #ebf4ff;
            color: #2b6cb0;
            border-radius: 5px;
            padding: 2px 8px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge-akr {
            display: inline-flex; align-items: center; justify-content: center;
            width: 24px; height: 24px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
        }
        .badge-a { background: #f0fff4; color: #276749; }
        .badge-b { background: #ebf8ff; color: #2c5282; }
        .badge-c { background: #fefcbf; color: #744210; }

        .btn-action {
            width: 28px; height: 28px;
            border: none; border-radius: 7px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 11px; cursor: pointer;
            transition: all .15s;
        }
        .btn-edit-act { background: #fef3c7; color: #d97706; }
        .btn-edit-act:hover { background: #fde68a; }
        .btn-del-act  { background: #fee2e2; color: #dc2626; }
        .btn-del-act:hover  { background: #fecaca; }

        .table-footer {
            display: flex; align-items: center; justify-content: space-between;
            padding: 11px 18px;
            border-top: 1px solid #f0f4f8;
            font-size: 12px; color: #a0aec0;
        }
        .pagination-wrap { display: flex; gap: 4px; }
        .page-pill {
            width: 28px; height: 28px;
            border: 1px solid #e2e8f0;
            background: #fff;
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; color: #4a5568; cursor: pointer;
            transition: all .15s;
            font-family: inherit;
        }
        .page-pill:hover { border-color: #a0aec0; }
        .page-pill.active { background: var(--navy); color: #fff; border-color: var(--navy); }

        /* ── FORM CARD ── */
        .form-card {
            background: #fff;
            border: 1px solid #e8ecf0;
            border-radius: 12px;
            overflow: hidden;
            max-width: 600px;
        }
        .form-card-header {
            display: flex; align-items: center; gap: 10px;
            padding: 16px 22px;
            border-bottom: 1px solid #f0f4f8;
        }
        .form-card-icon {
            width: 34px; height: 34px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
        }
        .form-card-header.create .form-card-icon { background: #ebf0f5; color: var(--navy); }
        .form-card-header.edit   .form-card-icon { background: #fef3c7; color: #d97706; }
        .form-card-title { font-size: 14px; font-weight: 600; color: #1a202c; }
        .form-card-body  { padding: 22px; }

        .field-group { margin-bottom: 18px; }
        .field-label {
            display: block;
            font-size: 12.5px;
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 6px;
        }
        .field-input, .field-select {
            width: 100%;
            background: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 9px 13px;
            font-size: 13.5px;
            color: #2d3748;
            font-family: inherit;
            outline: none;
            transition: border-color .15s, background .15s;
        }
        .field-input:focus, .field-select:focus {
            border-color: var(--navy);
            background: #fff;
        }
        .field-input.is-invalid, .field-select.is-invalid { border-color: #e53e3e; }
        .field-error { font-size: 11.5px; color: #e53e3e; margin-top: 5px; }
        .field-hint  { font-size: 11.5px; color: #a0aec0; margin-top: 4px; }

        .form-actions {
            display: flex; gap: 10px;
            padding: 16px 22px;
            border-top: 1px solid #f0f4f8;
            background: #fafbfd;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
                box-shadow: 4px 0 30px rgba(0,0,0,.25);
            }
            .main-wrap { margin-left: 0; }
            .topbar { left: 0; }
            .topbar-hamburger { display: flex; }
            .stat-cards { grid-template-columns: 1fr 1fr; }
            .search-input { width: 160px; }
        }
        @media (max-width: 480px) {
            .stat-cards { grid-template-columns: 1fr; }
            .page-content { padding: 14px 14px; }
            .topbar { padding: 0 14px; }
            .table-toolbar { flex-direction: column; align-items: flex-start; }
            .search-input { width: 100%; }
        }
    </style>
</head>
<body>

<!-- SIDEBAR OVERLAY (mobile) -->
<div id="sidebar-overlay" onclick="closeSidebar()"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:1039;"></div>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-logo">🎓</div>
        <div class="brand-title">Sistem Akademik</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu Utama</div>
        <a href="{{ route('dashboard') }}"
           class="nav-link-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        <div class="nav-section-label" style="margin-top:8px">Data Master</div>
        <a href="{{ route('mahasiswa.index') }}"
           class="nav-link-item {{ request()->is('mahasiswa*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Mahasiswa
        </a>
        <a href="{{ route('jurusan.index') }}"
           class="nav-link-item {{ request()->is('jurusan*') ? 'active' : '' }}">
            <i class="fas fa-building-columns"></i> Jurusan
        </a>
        <a href="{{ route('matakuliah.index') }}"
           class="nav-link-item {{ request()->is('matakuliah*') ? 'active' : '' }}">
            <i class="fas fa-book-open"></i> Matakuliah
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
            <div>
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-email">{{ auth()->user()->email }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-arrow-right-from-bracket"></i> Keluar
            </button>
        </form>
    </div>
</aside>

<!-- TOPBAR -->
<header class="topbar">
    <div class="topbar-left">
        <button class="topbar-hamburger" onclick="toggleSidebar()" aria-label="Menu">
            <i class="fas fa-bars" style="font-size:16px"></i>
        </button>
        <div>
            <div class="page-title">@yield('title', 'Dashboard')</div>
        </div>
    </div>
    <div class="topbar-right">
        <div class="topbar-icon-btn" title="Profil">
            <i class="fas fa-user"></i>
        </div>
    </div>
</header>

<!-- MAIN -->
<main class="main-wrap">
    <div class="page-content">
        @if(session('success'))
        <div class="alert-custom" id="success-alert">
            <i class="fas fa-circle-check"></i>
            {{ session('success') }}
            <button class="alert-close" onclick="document.getElementById('success-alert').remove()">×</button>
        </div>
        @endif

        @yield('content')
    </div>
</main>

<!-- MODAL KONFIRMASI HAPUS -->
<div id="delete-modal" style="
    display:none;position:fixed;inset:0;z-index:9999;
    background:rgba(0,0,0,.45);
    align-items:center;justify-content:center;
">
    <div style="
        background:#fff;border-radius:14px;
        width:100%;max-width:380px;margin:16px;
        overflow:hidden;
        animation: modal-in .18s ease;
    ">
        <div style="padding:24px 24px 0;text-align:center">
            <div style="
                width:52px;height:52px;border-radius:50%;
                background:#fff5f5;
                display:flex;align-items:center;justify-content:center;
                margin:0 auto 14px;font-size:22px;
            ">🗑️</div>
            <div style="font-size:16px;font-weight:700;color:#1a202c;margin-bottom:7px">
                Hapus Data
            </div>
            <div id="delete-modal-msg" style="font-size:13.5px;color:#718096;line-height:1.55">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
        </div>
        <div style="
            display:flex;gap:10px;
            padding:20px 24px 24px;
        ">
            <button onclick="closeDeleteModal()" style="
                flex:1;padding:10px;border-radius:9px;
                background:#f7fafc;border:1px solid #e2e8f0;
                font-size:13.5px;font-weight:500;color:#4a5568;
                cursor:pointer;font-family:inherit;transition:background .15s;
            " onmouseover="this.style.background='#edf2f7'"
              onmouseout="this.style.background='#f7fafc'">
                Batal
            </button>
            <button onclick="confirmDelete()" style="
                flex:1;padding:10px;border-radius:9px;
                background:#e53e3e;border:none;
                font-size:13.5px;font-weight:600;color:#fff;
                cursor:pointer;font-family:inherit;transition:background .15s;
                display:flex;align-items:center;justify-content:center;gap:6px;
            " onmouseover="this.style.background='#c53030'"
              onmouseout="this.style.background='#e53e3e'">
                <i class="fas fa-trash" style="font-size:12px"></i> Ya, Hapus
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        const s = document.getElementById('sidebar');
        const o = document.getElementById('sidebar-overlay');
        s.classList.toggle('open');
        o.style.display = s.classList.contains('open') ? 'block' : 'none';
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebar-overlay').style.display = 'none';
    }
    let _deleteForm = null;

    function hapus(formId, nama) {
        _deleteForm = document.getElementById(formId);
        document.getElementById('delete-modal-msg').innerHTML =
            'Apakah Anda yakin ingin menghapus <strong>' + nama + '</strong>?<br>' +
            '<span style="font-size:12px;color:#fc8181;margin-top:4px;display:block">Tindakan ini tidak dapat dibatalkan.</span>';
        const modal = document.getElementById('delete-modal');
        modal.style.display = 'flex';
    }

    function confirmDelete() {
        if (_deleteForm) _deleteForm.submit();
        closeDeleteModal();
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').style.display = 'none';
        _deleteForm = null;
    }

    // Tutup modal kalau klik di luar
    document.getElementById('delete-modal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    // Tutup dengan ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDeleteModal();
    });
</script>
</body>
</html>