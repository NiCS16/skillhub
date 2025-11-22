@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Cari Peserta oleh Kelas</h2>
    <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">Kembali ke Pendaftaran</a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Pilih Kelas</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('pendaftaran.peserta-by-kelas') }}" method="GET">
            <div class="row">
                <div class="col-md-8">
                    <select name="kelas_id" class="form-select" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelasList as $k)
                        <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelas }} - {{ $k->instruktur }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Cari Peserta</button>
                </div>
            </div>
        </form>
    </div>
</div>

@if(isset($kelas) && $kelas)
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Peserta yang Terdaftar di: {{ $kelas->nama_kelas }}</h5>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Kelas:</strong> {{ $kelas->nama_kelas }}</p>
                <p><strong>Instruktur:</strong> {{ $kelas->instruktur }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Deskripsi:</strong> {{ $kelas->deskripsi }}</p>
                <p><strong>Total Peserta:</strong> {{ $kelas->pesertas->count() }}</p>
            </div>
        </div>

        @if($kelas->pesertas->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Peserta</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kelas->pesertas as $peserta)
                    <tr>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ $peserta->email }}</td>
                        <td>{{ $peserta->telepon }}</td>
                        <td>
                            @if(isset($peserta->pivot->tanggal_daftar) && $peserta->pivot->tanggal_daftar)
                                {{ \Carbon\Carbon::parse($peserta->pivot->tanggal_daftar)->format('d M Y') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Belum ada peserta yang terdaftar di kelas ini.
        </div>
        @endif
    </div>
</div>
@endif
@endsection