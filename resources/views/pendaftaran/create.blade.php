@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Pendaftaran Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pendaftaran.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="peserta_id" class="form-label">Pilih Peserta</label>
                        <select class="form-select @error('peserta_id') is-invalid @enderror" 
                                id="peserta_id" name="peserta_id" required>
                            <option value="">-- Pilih Peserta --</option>
                            @foreach($pesertas as $peserta)
                            <option value="{{ $peserta->id }}" {{ old('peserta_id') == $peserta->id ? 'selected' : '' }}>
                                {{ $peserta->nama }} ({{ $peserta->email }})
                            </option>
                            @endforeach
                        </select>
                        @error('peserta_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="kelas_id" class="form-label">Pilih Kelas</label>
                        <select class="form-select @error('kelas_id') is-invalid @enderror" 
                                id="kelas_id" name="kelas_id" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $kela)
                            <option value="{{ $kela->id }}" {{ old('kelas_id') == $kela->id ? 'selected' : '' }}>
                                {{ $kela->nama_kelas }} - {{ $kela->instruktur }}
                            </option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="tanggal_daftar" class="form-label">Tanggal Pendaftaran</label>
                        <input type="date" class="form-control @error('tanggal_daftar') is-invalid @enderror" 
                               id="tanggal_daftar" name="tanggal_daftar" value="{{ old('tanggal_daftar', date('Y-m-d')) }}" required>
                        @error('tanggal_daftar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Pendaftaran</button>
                        <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection