@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Peserta</h2>
    <a href="{{ route('peserta.create') }}" class="btn btn-primary">Tambah Peserta</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesertas as $peserta)
            <tr>
                <td>{{ $peserta->id }}</td>
                <td><strong>{{ $peserta->nama }}</strong></td>
                <td>{{ $peserta->email }}</td>
                <td>{{ $peserta->telepon }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('peserta.show', $peserta->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('peserta.edit', $peserta->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('peserta.destroy', $peserta->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data peserta</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection