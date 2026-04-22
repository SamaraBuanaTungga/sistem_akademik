@extends('layouts.app')
@section('title', 'Tambah Matakuliah')
@section('content')

<div class="page-header">
    <div>
        <div class="page-header-title">Tambah Matakuliah</div>
        <div class="page-header-sub">Tambahkan matakuliah baru ke dalam sistem</div>
    </div>
    <a href="{{ route('matakuliah.index') }}" class="btn-secondary-custom">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="form-card">
    <div class="form-card-header create">
        <div class="form-card-icon"><i class="fas fa-book-medical"></i></div>
        <div class="form-card-title">Form Matakuliah Baru</div>
    </div>
    <div class="form-card-body">
        <form action="{{ route('matakuliah.store') }}" method="POST">
            @csrf
            <div class="field-group">
                <label class="field-label">Nama Matakuliah <span style="color:#e53e3e">*</span></label>
                <input type="text" name="nama_matakuliah"
                    class="field-input {{ $errors->has('nama_matakuliah') ? 'is-invalid' : '' }}"
                    placeholder="Contoh: Pemrograman Web 2"
                    value="{{ old('nama_matakuliah') }}">
                @error('nama_matakuliah')<div class="field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label class="field-label">SKS <span style="color:#e53e3e">*</span></label>
                <select name="sks" class="field-select {{ $errors->has('sks') ? 'is-invalid' : '' }}">
                    <option value="">-- Pilih SKS --</option>
                    @for($i=1; $i<=6; $i++)
                        <option value="{{ $i }}" {{ old('sks') == $i ? 'selected' : '' }}>
                            {{ $i }} SKS
                        </option>
                    @endfor
                </select>
                @error('sks')<div class="field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label class="field-label">Jurusan <span style="color:#e53e3e">*</span></label>
                <select name="id_jurusan" class="field-select {{ $errors->has('id_jurusan') ? 'is-invalid' : '' }}">
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
        <a href="{{ route('matakuliah.index') }}" class="btn-secondary-custom">Batal</a>
    </div>
        </form>
</div>
@endsection