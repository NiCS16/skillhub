@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Detail Peserta: {{ $peserta->nama }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">ID Peserta:</div>
                    <div class="col-md-8">{{ $peserta->id }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Nama Lengkap:</div>
                    <div class="col-md-8">{{ $peserta->nama }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Email:</div>
                    <div class="col-md-8">{{ $peserta->email }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Telepon:</div>
                    <div class="col-md-8">{{ $peserta->telepon }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Alamat:</div>
                    <div class="col-md-8">{{ $peserta->alamat }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Terdaftar Sejak:</div>
                    <div class="col-md-8">{{ $peserta->created_at->format('d M Y H:i') }}</div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('peserta.edit', $peserta->id) }}" class="btn btn-warning me-md-2">Edit</a>
                    <a href="{{ route('peserta.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection