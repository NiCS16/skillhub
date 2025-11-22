@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Cari Kelas oleh Peserta</h2>
    <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">Kembali ke Pendaftaran</a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Pilih Peserta</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('pendaftaran.kelas-by-peserta') }}" method="GET">
            <div class="row">
                <div class="col-md-8">
                    <select name="peserta_id" class="form-select" required>
                        <option value="">-- Pilih Peserta --</option>
                        @foreach($pesertas as $p)
                        <option value="{{ $p->id }}" {{ request('peserta_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }} ({{ $p->email }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Cari Kelas</button>
                </div>
            </div>
        </form>
    </div>
</div>

@if(isset($peserta) && $peserta)
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Kelas yang Diikuti oleh: {{ $peserta->nama }}</h5>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Nama:</strong> {{ $peserta->nama }}</p>
                <p><strong>Email:</strong> {{ $peserta->email }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Telepon:</strong> {{ $peserta->telepon }}</p>
                <p><strong>Total Kelas:</strong> {{ $peserta->kelas->count() }}</p>
            </div>
        </div>

        @if($peserta->kelas->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Kelas</th>
                        <th>Instruktur</th>
                        <th>Deskripsi</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peserta->kelas as $kelas)
                    <tr>
                        <td>{{ $kelas->nama_kelas }}</td>
                        <td>{{ $kelas->instruktur }}</td>
                        <td>{{ $kelas->deskripsi }}</td>
                        <td>
                            @if(isset($kelas->pivot->tanggal_daftar) && $kelas->pivot->tanggal_daftar)
                                {{ \Carbon\Carbon::parse($kelas->pivot->tanggal_daftar)->format('d M Y') }}
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
            <i class="fas fa-info-circle"></i> Peserta ini belum terdaftar di kelas manapun.
        </div>
        @endif
    </div>
</div>
@endif
@endsection