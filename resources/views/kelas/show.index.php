@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Detail Kelas: {{ $kela->nama_kelas }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">ID Kelas:</div>
                    <div class="col-md-8">{{ $kela->id }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Nama Kelas:</div>
                    <div class="col-md-8">{{ $kela->nama_kelas }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Instruktur:</div>
                    <div class="col-md-8">{{ $kela->instruktur }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Deskripsi:</div>
                    <div class="col-md-8">{{ $kela->deskripsi }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Dibuat:</div>
                    <div class="col-md-8">{{ $kela->created_at->format('d M Y H:i') }}</div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('kelas.edit', $kela->id) }}" class="btn btn-warning me-md-2">Edit</a>
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection