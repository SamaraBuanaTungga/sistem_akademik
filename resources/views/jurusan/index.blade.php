@extends('layouts.app')
@section('title', 'Data Jurusan')
@section('content')

<div class="page-header">
    <div>
        <div class="page-header-title">Data Jurusan</div>
        <div class="page-header-sub">Kelola data program studi</div>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="{{ route('jurusan.print') }}" target="_blank" class="btn-primary-custom" style="background-color: #475569;">
            <i class="fas fa-print"></i> Cetak PDF
        </a>
        <a href="{{ route('jurusan.export-excel') }}" class="btn-export-excel" style="background: #38a169; color: #fff; padding: 8px 14px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 500; display: inline-flex; align-items: center; gap: 6px;">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
        <a href="{{ route('jurusan.export-csv') }}" class="btn-export-csv" style="background: #319795; color: #fff; padding: 8px 14px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 500; display: inline-flex; align-items: center; gap: 6px;">
            <i class="fas fa-file-csv"></i> Export CSV
        </a>
        <a href="{{ route('jurusan.create') }}" class="btn-primary-custom">
            <i class="fas fa-plus"></i> Tambah Jurusan
        </a>
    </div>
</div>

<div class="table-card">
    <div class="table-toolbar">
        <div class="table-toolbar-title">Daftar Jurusan</div>
        <form method="GET">
            <div class="search-input-wrap">
                <i class="fas fa-search"></i>
                <input type="text" name="search" class="search-input"
                    placeholder="Cari jurusan..." value="{{ request('search') }}">
            </div>
        </form>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Jurusan</th>
                <th>Akreditasi</th>
                <th>Mahasiswa</th>
                <th>Matakuliah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jurusans as $j)
            <tr>
                <td class="no-num">{{ $loop->iteration + ($jurusans->currentPage()-1)*$jurusans->perPage() }}</td>
                <td><strong>{{ $j->nama_jurusan }}</strong></td>
                <td>
                    @php $ak = $j->akreditasi @endphp
                    <span class="badge-akr {{ $ak=='A' ? 'badge-a' : ($ak=='B' ? 'badge-b' : 'badge-c') }}">
                        {{ $ak }}
                    </span>
                </td>
                <td>{{ $j->mahasiswas->count() }} orang</td>
                <td>{{ $j->matakuliahs->count() }} mk</td>
                <td>
                    <div style="display:flex;gap:5px;align-items:center">
                        <a href="{{ route('jurusan.edit', $j) }}" class="btn-action btn-edit-act">
                            <i class="fas fa-pencil"></i>
                        </a>
                        <form id="del-jrs-{{ $j->id_jurusan }}"
                            action="{{ route('jurusan.destroy', $j) }}"
                            method="POST" style="margin:0;padding:0">
                            @csrf @method('DELETE')
                        </form>
                        <button type="button" class="btn-action btn-del-act"
                            onclick="hapus('del-jrs-{{ $j->id_jurusan }}', '{{ addslashes($j->nama_jurusan) }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:30px;color:#a0aec0;">
                    <i class="fas fa-inbox" style="font-size:24px;display:block;margin-bottom:8px"></i>
                    Belum ada data jurusan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="table-footer">
        <span>{{ $jurusans->total() }} total data</span>
        <div class="pagination-wrap">
            @for($p = 1; $p <= $jurusans->lastPage(); $p++)
            <a href="{{ $jurusans->url($p) }}"
               class="page-pill {{ $jurusans->currentPage() == $p ? 'active' : '' }}">{{ $p }}</a>
            @endfor
        </div>
    </div>
</div>
@endsection