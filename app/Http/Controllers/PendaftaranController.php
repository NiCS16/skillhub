<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\Kelas;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::with(['peserta', 'kelas'])->latest()->get();
        return view('pendaftaran.index', compact('pendaftarans'));
    }

    public function create()
    {
        $pesertas = Peserta::all();
        $kelas = Kelas::all();
        return view('pendaftaran.create', compact('pesertas', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peserta_id' => 'required|exists:pesertas,id',
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_daftar' => 'required|date'
        ]);

        // Cek apakah peserta sudah terdaftar di kelas yang sama
        $existing = Pendaftaran::where('peserta_id', $request->peserta_id)
                              ->where('kelas_id', $request->kelas_id)
                              ->exists();

        if ($existing) {
            return redirect()->back()->with('error', 'Peserta sudah terdaftar di kelas ini');
        }

        Pendaftaran::create($request->all());
        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil ditambahkan');
    }

    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['peserta', 'kelas']);
        return view('pendaftaran.show', compact('pendaftaran'));
    }

    public function edit(Pendaftaran $pendaftaran)
    {
        $pesertas = Peserta::all();
        $kelas = Kelas::all();
        return view('pendaftaran.edit', compact('pendaftaran', 'pesertas', 'kelas'));
    }

    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'peserta_id' => 'required|exists:pesertas,id',
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_daftar' => 'required|date'
        ]);

        // Cek duplikasi untuk peserta dan kelas yang sama (kecuali record ini)
        $existing = Pendaftaran::where('peserta_id', $request->peserta_id)
                              ->where('kelas_id', $request->kelas_id)
                              ->where('id', '!=', $pendaftaran->id)
                              ->exists();

        if ($existing) {
            return redirect()->back()->with('error', 'Peserta sudah terdaftar di kelas ini');
        }

        $pendaftaran->update($request->all());
        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil diupdate');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();
        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus');
    }
    
    /**
     * Menampilkan kelas oleh peserta
     */
    public function kelasByPeserta(Request $request)
    {
        $pesertas = \App\Models\Peserta::all();
        
        if ($request->has('peserta_id') && $request->peserta_id) {
            // PAKAI RELATIONSHIP dengan withPivot
            $peserta = \App\Models\Peserta::with(['kelas' => function($query) {
                $query->withPivot('tanggal_daftar');
            }])->find($request->peserta_id);
                
            return view('pendaftaran.kelas-by-peserta', compact('pesertas', 'peserta'));
        }
        
        return view('pendaftaran.kelas-by-peserta', compact('pesertas'));
    }

    public function pesertaByKelas(Request $request)
    {
        $kelasList = \App\Models\Kelas::all();
        
        if ($request->has('kelas_id') && $request->kelas_id) {
            // PAKAI RELATIONSHIP dengan withPivot
            $kelas = \App\Models\Kelas::with(['pesertas' => function($query) {
                $query->withPivot('tanggal_daftar');
            }])->find($request->kelas_id);
                
            return view('pendaftaran.peserta-by-kelas', compact('kelasList', 'kelas'));
        }
        
        return view('pendaftaran.peserta-by-kelas', compact('kelasList'));
    }
}