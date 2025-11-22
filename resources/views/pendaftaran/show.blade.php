@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Detail Pendaftaran</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">ID Pendaftaran:</div>
                    <div class="col-md-8">{{ $pendaftaran->id }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Peserta:</div>
                    <div class="col-md-8">
                        <strong>{{ $pendaftaran->peserta->nama }}</strong><br>
                        <small class="text-muted">Email: {{ $pendaftaran->peserta->email }}</small><br>
                        <small class="text-muted">Telp: {{ $pendaftaran->peserta->telepon }}</small>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Kelas:</div>
                    <div class="col-md-8">
                        <strong>{{ $pendaftaran->kelas->nama_kelas }}</strong><br>
                        <small class="text-muted">Instruktur: {{ $pendaftaran->kelas->instruktur }}</small><br>
                        <small class="text-muted">Deskripsi: {{ $pendaftaran->kelas->deskripsi }}</small>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Tanggal Daftar:</div>
                    <div class="col-md-8">{{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->format('d M Y') }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Dibuat Pada:</div>
                    <div class="col-md-8">{{ $pendaftaran->created_at->format('d M Y H:i') }}</div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('pendaftaran.edit', $pendaftaran->id) }}" class="btn btn-warning me-md-2">Edit</a>
                    <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection