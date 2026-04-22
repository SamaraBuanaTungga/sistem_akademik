@extends('layouts.app')
@section('title', 'Tambah Jurusan')
@section('content')

<div class="page-header">
    <div>
        <div class="page-header-title">Tambah Jurusan</div>
        <div class="page-header-sub">Isi form berikut untuk menambah data jurusan baru</div>
    </div>
    <a href="{{ route('jurusan.index') }}" class="btn-secondary-custom">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="form-card">
    <div class="form-card-header create">
        <div class="form-card-icon"><i class="fas fa-building-columns"></i></div>
        <div class="form-card-title">Form Jurusan Baru</div>
    </div>
    <div class="form-card-body">
        <form action="{{ route('jurusan.store') }}" method="POST">
            @csrf
            <div class="field-group">
                <label class="field-label">Nama Jurusan <span style="color:#e53e3e">*</span></label>
                <input type="text" name="nama_jurusan"
                    class="field-input {{ $errors->has('nama_jurusan') ? 'is-invalid' : '' }}"
                    placeholder="Contoh: Teknik Informatika"
                    value="{{ old('nama_jurusan') }}">
                @error('nama_jurusan')
                    <div class="field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>
            <div class="field-group">
                <label class="field-label">Akreditasi <span style="color:#e53e3e">*</span></label>
                <select name="akreditasi" class="field-select {{ $errors->has('akreditasi') ? 'is-invalid' : '' }}">
                    <option value="">-- Pilih Akreditasi --</option>
                    @foreach(['A','B','C'] as $ak)
                        <option value="{{ $ak }}" {{ old('akreditasi') == $ak ? 'selected' : '' }}>
                            Akreditasi {{ $ak }}
                        </option>
                    @endforeach
                </select>
                @error('akreditasi')
                    <div class="field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn-primary-custom"><i class="fas fa-floppy-disk"></i> Simpan</button>
        <a href="{{ route('jurusan.index') }}" class="btn-secondary-custom">Batal</a>
    </div>
        </form>
</div>
@endsection