@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Pendaftaran</h2>
    <div>
        <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary">Tambah Pendaftaran</a>
        <a href="{{ route('peserta.index') }}" class="btn btn-outline-secondary">Lihat Peserta</a>
        <a href="{{ route('kelas.index') }}" class="btn btn-outline-secondary">Lihat Kelas</a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Peserta</th>
                <th>Kelas</th>
                <th>Tanggal Daftar</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftarans as $pendaftaran)
            <tr>
                <td>{{ $pendaftaran->id }}</td>
                <td>
                    <strong>{{ $pendaftaran->peserta->nama }}</strong>
                    <br><small class="text-muted">{{ $pendaftaran->peserta->email }}</small>
                </td>
                <td>
                    <strong>{{ $pendaftaran->kelas->nama_kelas }}</strong>
                    <br><small class="text-muted">Oleh: {{ $pendaftaran->kelas->instruktur }}</small>
                </td>
                <td>{{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->format('d M Y') }}</td>
                <td>{{ $pendaftaran->created_at->format('d M Y H:i') }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('pendaftaran.show', $pendaftaran->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('pendaftaran.edit', $pendaftaran->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pendaftaran.destroy', $pendaftaran->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pendaftaran ini?')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data pendaftaran</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Cari Kelas oleh Peserta</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pendaftaran.kelas-by-peserta') }}" method="GET">
                    <div class="input-group">
                        <select name="peserta_id" class="form-select" required>
                            <option value="">Pilih Peserta</option>
                            @foreach(App\Models\Peserta::all() as $peserta)
                            <option value="{{ $peserta->id }}">{{ $peserta->nama }} ({{ $peserta->email }})</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Cari Kelas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Cari Peserta di Kelas</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pendaftaran.peserta-by-kelas') }}" method="GET">
                    <div class="input-group">
                        <select name="kelas_id" class="form-select" required>
                            <option value="">Pilih Kelas</option>
                            @foreach(App\Models\Kelas::all() as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Cari Peserta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection