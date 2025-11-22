@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="jumbotron bg-primary text-white p-5 rounded mb-4">
                <h1 class="display-4">Selamat Datang di SkillHub</h1>
                <p class="lead">Sistem Pengelolaan Kursus dan Pelatihan</p>
                <hr class="my-4">
                <p>Kelola data peserta, kelas, dan pendaftaran dengan mudah dan efisien.</p>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">📊 Manajemen Peserta</h5>
                            <p class="card-text">Kelola data peserta, tambah, edit, dan hapus informasi peserta.</p>
                            <a href="{{ route('peserta.index') }}" class="btn btn-primary">Kelola Peserta</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">🎓 Manajemen Kelas</h5>
                            <p class="card-text">Kelola berbagai kelas pelatihan yang tersedia.</p>
                            <a href="{{ route('kelas.index') }}" class="btn btn-success">Kelola Kelas</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">📝 Pendaftaran</h5>
                            <p class="card-text">Kelola pendaftaran peserta ke kelas pelatihan.</p>
                            <a href="{{ route('pendaftaran.index') }}" class="btn btn-info">Kelola Pendaftaran</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Statistik Singkat</h5>
                        </div>
                        <div class="card-body">
                            @php
                                use App\Models\Peserta;
                                use App\Models\Kelas;
                                use App\Models\Pendaftaran;
                            @endphp
                            <p>Total Peserta: <strong>{{ Peserta::count() }}</strong></p>
                            <p>Total Kelas: <strong>{{ Kelas::count() }}</strong></p>
                            <p>Total Pendaftaran: <strong>{{ Pendaftaran::count() }}</strong></p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Kelas Tersedia</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach(App\Models\Kelas::latest()->take(5)->get() as $kelas)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $kelas->nama_kelas }}
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $kelas->pendaftarans->count() }} peserta
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection