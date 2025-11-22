@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Kelas Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('kelas.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_kelas" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" 
                               id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}" required>
                        @error('nama_kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="instruktur" class="form-label">Instruktur</label>
                        <input type="text" class="form-control @error('instruktur') is-invalid @enderror" 
                               id="instruktur" name="instruktur" value="{{ old('instruktur') }}" required>
                        @error('instruktur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Simpan Kelas</button>
                        <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection