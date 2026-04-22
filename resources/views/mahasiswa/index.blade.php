@extends('layouts.app')
@section('title', 'Data Mahasiswa')
@section('content')

<div class="page-header">
    <div>
        <div class="page-header-title">Data Mahasiswa</div>
        <div class="page-header-sub">Kelola data mahasiswa beserta informasi jurusan</div>
    </div>
    <a href="{{ route('mahasiswa.create') }}" class="btn-primary-custom">
        <i class="fas fa-user-plus"></i> Tambah Mahasiswa
    </a>
</div>

<div class="table-card">
    <div class="table-toolbar" style="flex-wrap:wrap;gap:10px">
        <div class="table-toolbar-title">
            Daftar Mahasiswa
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
                    placeholder="Cari nama / NIM..." value="{{ request('search') }}">
            </div>
            @if(request('jurusan') || request('search'))
            <a href="{{ route('mahasiswa.index') }}"
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
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Jurusan</th>
                <th>Akreditasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mahasiswas as $m)
            <tr>
                <td class="no-num">{{ $loop->iteration + ($mahasiswas->currentPage()-1)*$mahasiswas->perPage() }}</td>
                <td><span class="nim-tag">{{ $m->nim }}</span></td>
                <td>{{ $m->nama }}</td>
                <td>{{ $m->jurusan->nama_jurusan ?? '-' }}</td>
                <td>
                    @php $ak = $m->jurusan->akreditasi ?? '-' @endphp
                    <span class="badge-akr {{ $ak=='A' ? 'badge-a' : ($ak=='B' ? 'badge-b' : 'badge-c') }}">
                        {{ $ak }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:5px;align-items:center">
                        <a href="{{ route('mahasiswa.edit', $m) }}" class="btn-action btn-edit-act">
                            <i class="fas fa-pencil"></i>
                        </a>
                        <form id="del-mhs-{{ $m->id_mahasiswa }}"
                            action="{{ route('mahasiswa.destroy', $m) }}"
                            method="POST" style="margin:0;padding:0">
                            @csrf @method('DELETE')
                        </form>
                        <button type="button" class="btn-action btn-del-act"
                            onclick="hapus('del-mhs-{{ $m->id_mahasiswa }}', '{{ addslashes($m->nama) }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:30px;color:#a0aec0;">
                    <i class="fas fa-inbox" style="font-size:24px;display:block;margin-bottom:8px"></i>
                    Belum ada data mahasiswa
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="table-footer">
        <span>{{ $mahasiswas->total() }} total data</span>
        <div class="pagination-wrap">
            @for($p = 1; $p <= $mahasiswas->lastPage(); $p++)
            <a href="{{ $mahasiswas->withQueryString()->url($p) }}"
               class="page-pill {{ $mahasiswas->currentPage() == $p ? 'active' : '' }}">{{ $p }}</a>
            @endfor
        </div>
    </div>
</div>
@endsection