@extends('layouts.app')
@section('title', 'Tambah Mahasiswa')
@section('content')

<div class="page-header">
    <div>
        <div class="page-header-title">Tambah Mahasiswa</div>
        <div class="page-header-sub">Isi form untuk mendaftarkan mahasiswa baru</div>
    </div>
    <a href="{{ route('mahasiswa.index') }}" class="btn-secondary-custom">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="form-card">
    <div class="form-card-header create">
        <div class="form-card-icon"><i class="fas fa-user-plus"></i></div>
        <div class="form-card-title">Form Mahasiswa Baru</div>
    </div>
    <div class="form-card-body">
        <form action="{{ route('mahasiswa.store') }}" method="POST">
            @csrf
            <div class="field-group">
                <label class="field-label">NIM <span style="color:#e53e3e">*</span></label>
                <input type="text" name="nim"
                    class="field-input {{ $errors->has('nim') ? 'is-invalid' : '' }}"
                    placeholder="Contoh: 2601001"
                    value="{{ old('nim') }}">
                <div class="field-hint">NIM harus unik, tidak boleh sama dengan mahasiswa lain</div>
                @error('nim')<div class="field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label class="field-label">Nama Lengkap <span style="color:#e53e3e">*</span></label>
                <input type="text" name="nama"
                    class="field-input {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                    placeholder="Nama lengkap mahasiswa"
                    value="{{ old('nama') }}">
                @error('nama')<div class="field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label class="field-label">Jurusan <span style="color:#e53e3e">*</span></label>
                <select name="id_jurusan"
                    class="field-select {{ $errors->has('id_jurusan') ? 'is-invalid' : '' }}">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusans as $j)
                        <option value="{{ $j->id_jurusan }}"
                            {{ old('id_jurusan') == $j->id_jurusan ? 'selected' : '' }}>
                            {{ $j->nama_jurusan }} — Akreditasi {{ $j->akreditasi }}
                        </option>
                    @endforeach
                </select>
                @error('id_jurusan')<div class="field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>@enderror
            </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn-primary-custom"><i class="fas fa-floppy-disk"></i> Simpan</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn-secondary-custom">Batal</a>
    </div>
        </form>
</div>
@endsection