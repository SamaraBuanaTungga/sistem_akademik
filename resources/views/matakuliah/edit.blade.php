@extends('layouts.app')
@section('title', 'Edit Matakuliah')
@section('content')

<div class="page-header">
    <div>
        <div class="page-header-title">Edit Matakuliah</div>
        <div class="page-header-sub">Perbarui informasi matakuliah</div>
    </div>
    <a href="{{ route('matakuliah.index') }}" class="btn-secondary-custom">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="form-card">
    <div class="form-card-header edit">
        <div class="form-card-icon"><i class="fas fa-book-open"></i></div>
        <div class="form-card-title">Edit: {{ $matakuliah->nama_matakuliah }}</div>
    </div>
    <div class="form-card-body">
        <form action="{{ route('matakuliah.update', $matakuliah) }}" method="POST">
            @csrf @method('PUT')
            <div class="field-group">
                <label class="field-label">Nama Matakuliah</label>
                <input type="text" name="nama_matakuliah" class="field-input"
                    value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}">
                @error('nama_matakuliah')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label class="field-label">SKS</label>
                <select name="sks" class="field-select">
                    @for($i=1; $i<=6; $i++)
                        <option value="{{ $i }}"
                            {{ old('sks', $matakuliah->sks) == $i ? 'selected' : '' }}>
                            {{ $i }} SKS
                        </option>
                    @endfor
                </select>
            </div>
            <div class="field-group">
                <label class="field-label">Jurusan</label>
                <select name="id_jurusan" class="field-select">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusans as $j)
                        <option value="{{ $j->id_jurusan }}"
                            {{ old('id_jurusan', $matakuliah->id_jurusan) == $j->id_jurusan ? 'selected' : '' }}>
                            {{ $j->nama_jurusan }} — Akreditasi {{ $j->akreditasi }}
                        </option>
                    @endforeach
                </select>
                @error('id_jurusan')<div class="field-error">{{ $message }}</div>@enderror
            </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn-primary-custom"><i class="fas fa-floppy-disk"></i> Update</button>
        <a href="{{ route('matakuliah.index') }}" class="btn-secondary-custom">Batal</a>
    </div>
        </form>
</div>
@endsection