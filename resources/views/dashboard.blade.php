@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

@php
    $jurusans = \App\Models\Jurusan::withCount(['mahasiswas','matakuliahs'])->get();
    $totalMhs = \App\Models\Mahasiswa::count();
    $totalMk  = \App\Models\Matakuliah::count();
    $totalJrs = $jurusans->count();
@endphp

{{-- STAT CARDS --}}
<div class="stat-cards" style="margin-bottom:22px">
    <div class="stat-card navy">
        <div class="stat-icon-wrap"><i class="fas fa-building-columns"></i></div>
        <div class="stat-label">Total Jurusan</div>
        <div class="stat-value">{{ $totalJrs }}</div>
        <div class="stat-desc">Program studi aktif</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon-wrap"><i class="fas fa-users"></i></div>
        <div class="stat-label">Total Mahasiswa</div>
        <div class="stat-value">{{ $totalMhs }}</div>
        <div class="stat-desc">Mahasiswa terdaftar</div>
    </div>
    <div class="stat-card red">
        <div class="stat-icon-wrap"><i class="fas fa-book-open"></i></div>
        <div class="stat-label">Total Matakuliah</div>
        <div class="stat-value">{{ $totalMk }}</div>
        <div class="stat-desc">Matakuliah tersedia</div>
    </div>
</div>

{{-- JURUSAN CARDS --}}
<div style="margin-bottom:14px">
    <div class="page-header-title">Ringkasan Per Jurusan</div>
    <div class="page-header-sub">Data mahasiswa dan matakuliah di setiap program studi</div>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px;margin-bottom:24px">
    @foreach($jurusans as $j)
    @php
        $pct = $totalMhs > 0 ? round($j->mahasiswas_count / $totalMhs * 100) : 0;
        $colors = ['#1a2e44','#2563eb','#059669','#dc2626','#7c3aed'];
        $c = $colors[$loop->index % count($colors)];
    @endphp
    <div style="background:#fff;border:1px solid #e8ecf0;border-radius:12px;overflow:hidden;">
        {{-- Header strip --}}
        <div style="background:{{ $c }};padding:16px 20px;display:flex;align-items:center;justify-content:space-between;">
            <div>
                <div style="color:rgba(255,255,255,.6);font-size:11px;margin-bottom:3px">Program Studi</div>
                <div style="color:#fff;font-size:14px;font-weight:600;line-height:1.3">{{ $j->nama_jurusan }}</div>
            </div>
            <div style="background:rgba(255,255,255,.15);border-radius:8px;padding:6px 10px;text-align:center;">
                <div style="color:#fff;font-size:18px;font-weight:700;line-height:1">{{ $j->akreditasi }}</div>
                <div style="color:rgba(255,255,255,.6);font-size:10px">Akreditasi</div>
            </div>
        </div>
        {{-- Body --}}
        <div style="padding:16px 20px">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px">
                <div style="background:#f7fafc;border-radius:8px;padding:10px 12px;text-align:center">
                    <div style="font-size:22px;font-weight:700;color:#1a202c">{{ $j->mahasiswas_count }}</div>
                    <div style="font-size:11px;color:#718096;margin-top:2px"><i class="fas fa-users" style="margin-right:3px"></i>Mahasiswa</div>
                </div>
                <div style="background:#f7fafc;border-radius:8px;padding:10px 12px;text-align:center">
                    <div style="font-size:22px;font-weight:700;color:#1a202c">{{ $j->matakuliahs_count }}</div>
                    <div style="font-size:11px;color:#718096;margin-top:2px"><i class="fas fa-book-open" style="margin-right:3px"></i>Matakuliah</div>
                </div>
            </div>
            {{-- Progress bar --}}
            <div style="font-size:11px;color:#a0aec0;margin-bottom:5px;display:flex;justify-content:space-between">
                <span>Proporsi mahasiswa</span>
                <span style="font-weight:600;color:#4a5568">{{ $pct }}%</span>
            </div>
            <div style="background:#edf2f7;border-radius:99px;height:6px;overflow:hidden">
                <div style="height:100%;width:{{ $pct }}%;background:{{ $c }};border-radius:99px;transition:width .4s"></div>
            </div>
        </div>
        {{-- Footer links --}}
        <div style="display:flex;border-top:1px solid #f0f4f8">
            <a href="{{ route('mahasiswa.index', ['jurusan' => $j->id_jurusan]) }}"
               style="flex:1;padding:10px;text-align:center;font-size:12px;color:#718096;text-decoration:none;transition:background .15s"
               onmouseover="this.style.background='#f7fafc'" onmouseout="this.style.background=''">
                <i class="fas fa-users" style="margin-right:4px"></i>Lihat Mahasiswa
            </a>
            <div style="width:1px;background:#f0f4f8"></div>
            <a href="{{ route('matakuliah.index', ['jurusan' => $j->id_jurusan]) }}"
               style="flex:1;padding:10px;text-align:center;font-size:12px;color:#718096;text-decoration:none;transition:background .15s"
               onmouseover="this.style.background='#f7fafc'" onmouseout="this.style.background=''">
                <i class="fas fa-book-open" style="margin-right:4px"></i>Lihat MK
            </a>
        </div>
    </div>
    @endforeach
</div>

@endsection