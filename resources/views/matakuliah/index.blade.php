@extends('layouts.app')
@section('title', 'Data Matakuliah')
@section('content')

<div class="page-header">
    <div>
        <div class="page-header-title">Data Matakuliah</div>
        <div class="page-header-sub">Kelola daftar matakuliah per jurusan</div>
    </div>
    <a href="{{ route('matakuliah.create') }}" class="btn-primary-custom">
        <i class="fas fa-plus"></i> Tambah Matakuliah
    </a>
</div>

<div class="table-card">
    <div class="table-toolbar" style="flex-wrap:wrap;gap:10px">
        <div class="table-toolbar-title">
            Daftar Matakuliah
            @if(request('jurusan'))
                @php $selectedJrs = $jurusans->firstWhere('id_jurusan', request('jurusan')) @endphp
                @if($selectedJrs)
                <span style="font-size:11px;font-weight:400;color:#718096;margin-left:6px">
                    — {{ $selectedJrs->nama_jurusan }}
                </span>
                @endif
            @endif
        </div>
        <form method="GET" style="display:flex;gap:8px;flex-wrap:wrap;align-items:center">
            {{-- Filter jurusan --}}
            <select name="jurusan" onchange="this.form.submit()"
                style="background:#f7fafc;border:1px solid #e8ecf0;border-radius:8px;
                    padding:7px 12px;font-size:13px;color:#4a5568;font-family:inherit;outline:none;cursor:pointer">
                <option value="">Semua Jurusan</option>
                @foreach($jurusans as $j)
                    <option value="{{ $j->id_jurusan }}" {{ request('jurusan') == $j->id_jurusan ? 'selected' : '' }}>
                        {{ $j->nama_jurusan }}
                    </option>
                @endforeach
            </select>
            {{-- Search --}}
            <div class="search-input-wrap">
                <i class="fas fa-search"></i>
                <input type="text" name="search" class="search-input"
                    placeholder="Cari matakuliah..." value="{{ request('search') }}">
            </div>
            @if(request('jurusan') || request('search'))
            <a href="{{ route('matakuliah.index') }}"
            style="font-size:12px;color:#a0aec0;text-decoration:none;padding:7px 4px">
                <i class="fas fa-xmark"></i> Reset
            </a>
            @endif
        </form>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Matakuliah</th>
                <th>SKS</th>
                <th>Jurusan</th>
                <th>Akreditasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($matakuliahs as $mk)
            <tr>
                <td class="no-num">{{ $loop->iteration + ($matakuliahs->currentPage()-1)*$matakuliahs->perPage() }}</td>
                <td>{{ $mk->nama_matakuliah }}</td>
                <td><span class="sks-tag">{{ $mk->sks }} SKS</span></td>
                <td>{{ $mk->jurusan->nama_jurusan ?? '-' }}</td>
                <td>
                    @php $ak = $mk->jurusan->akreditasi ?? '-' @endphp
                    <span class="badge-akr {{ $ak=='A' ? 'badge-a' : ($ak=='B' ? 'badge-b' : 'badge-c') }}">
                        {{ $ak }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:5px;align-items:center">
                        <a href="{{ route('matakuliah.edit', $mk) }}" class="btn-action btn-edit-act">
                            <i class="fas fa-pencil"></i>
                        </a>
                        <form id="del-mk-{{ $mk->id_matakuliah }}"
                            action="{{ route('matakuliah.destroy', $mk) }}"
                            method="POST" style="margin:0;padding:0">
                            @csrf @method('DELETE')
                        </form>
                        <button type="button" class="btn-action btn-del-act"
                            onclick="hapus('del-mk-{{ $mk->id_matakuliah }}', '{{ addslashes($mk->nama_matakuliah) }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:30px;color:#a0aec0;">
                    <i class="fas fa-inbox" style="font-size:24px;display:block;margin-bottom:8px"></i>
                    Belum ada data matakuliah
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="table-footer">
        <span>{{ $matakuliahs->total() }} total data</span>
        <div class="pagination-wrap">
            @for($p = 1; $p <= $matakuliahs->lastPage(); $p++)
            <a href="{{ $matakuliahs->withQueryString()->url($p) }}"
               class="page-pill {{ $matakuliahs->currentPage() == $p ? 'active' : '' }}">{{ $p }}</a>
            @endfor
        </div>
    </div>
</div>
@endsection