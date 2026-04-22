@extends('layouts.app')
@section('title', 'Edit Jurusan')
@section('content')

<div class="page-header">
    <div>
        <div class="page-header-title">Edit Jurusan</div>
        <div class="page-header-sub">Perbarui data jurusan</div>
    </div>
    <a href="{{ route('jurusan.index') }}" class="btn-secondary-custom">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="form-card">
    <div class="form-card-header edit">
        <div class="form-card-icon"><i class="fas fa-pencil"></i></div>
        <div class="form-card-title">Edit: {{ $jurusan->nama_jurusan }}</div>
    </div>
    <div class="form-card-body">
        <form action="{{ route('jurusan.update', $jurusan) }}" method="POST">
            @csrf @method('PUT')
            <div class="field-group">
                <label class="field-label">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" class="field-input"
                    value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}">
                @error('nama_jurusan')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="field-group">
                <label class="field-label">Akreditasi</label>
                <select name="akreditasi" class="field-select">
                    @foreach(['A','B','C'] as $ak)
                        <option value="{{ $ak }}" {{ old('akreditasi', $jurusan->akreditasi) == $ak ? 'selected' : '' }}>
                            Akreditasi {{ $ak }}
                        </option>
                    @endforeach
                </select>
            </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn-primary-custom"><i class="fas fa-floppy-disk"></i> Update</button>
        <a href="{{ route('jurusan.index') }}" class="btn-secondary-custom">Batal</a>
    </div>
        </form>
</div>
@endsection