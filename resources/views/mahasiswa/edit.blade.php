@extends('layouts.app')
@section('title', 'Edit Mahasiswa')
@section('content')

<div class="page-header">
    <div>
        <div class="page-header-title">Edit Mahasiswa</div>
        <div class="page-header-sub">Perbarui data mahasiswa</div>
    </div>
    <a href="{{ route('mahasiswa.index') }}" class="btn-secondary-custom">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="form-card">
    <div class="form-card-header edit">
        <div class="form-card-icon"><i class="fas fa-user-pen"></i></div>
        <div class="form-card-title">Edit: {{ $mahasiswa->nama }}</div>
    </div>
    <div class="form-card-body">
        <form action="{{ route('mahasiswa.update', $mahasiswa) }}" method="POST">
            @csrf @method('PUT')
            <div class="field-group">
                <label class="field-label">NIM</label>
                <input type="text" name="nim" class="field-input"
                    value="{{ old('nim', $mahasiswa->nim) }}">
                @error('nim')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label class="field-label">Nama Lengkap</label>
                <input type="text" name="nama" class="field-input"
                    value="{{ old('nama', $mahasiswa->nama) }}">
                @error('nama')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label class="field-label">Jurusan</label>
                <select name="id_jurusan" class="field-select">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusans as $j)
                        <option value="{{ $j->id_jurusan }}"
                            {{ old('id_jurusan', $mahasiswa->id_jurusan) == $j->id_jurusan ? 'selected' : '' }}>
                            {{ $j->nama_jurusan }} — Akreditasi {{ $j->akreditasi }}
                        </option>
                    @endforeach
                </select>
                @error('id_jurusan')<div class="field-error">{{ $message }}</div>@enderror
            </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn-primary-custom"><i class="fas fa-floppy-disk"></i> Update</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn-secondary-custom">Batal</a>
    </div>
        </form>
</div>
@endsection