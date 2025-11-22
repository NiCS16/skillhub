@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Kelas</h2>
    <a href="{{ route('kelas.create') }}" class="btn btn-primary">Tambah Kelas</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Kelas</th>
                <th>Instruktur</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kelas as $kela)
            <tr>
                <td>{{ $kela->id }}</td>
                <td><strong>{{ $kela->nama_kelas }}</strong></td>
                <td>{{ $kela->instruktur }}</td>
                <td>{{ Str::limit($kela->deskripsi, 50) }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('kelas.show', $kela->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('kelas.edit', $kela->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kelas.destroy', $kela->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kelas ini?')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data kelas</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection