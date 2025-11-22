<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index()
    {
        $pesertas = Peserta::all();
        return view('peserta.index', compact('pesertas'));
    }

    public function create()
    {
        return view('peserta.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pesertas',
            'telepon' => 'required',
            'alamat' => 'required'
        ]);

        Peserta::create($request->all());
        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil ditambahkan');
    }

    public function show(Peserta $peserta)
    {
        return view('peserta.show', compact('peserta'));
    }

    public function edit(Peserta $peserta)
    {
        return view('peserta.edit', compact('peserta'));
    }

    public function update(Request $request, Peserta $peserta)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pesertas,email,' . $peserta->id,
            'telepon' => 'required',
            'alamat' => 'required'
        ]);

        $peserta->update($request->all());
        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil diupdate');
    }

    public function destroy(Peserta $peserta)
    {
        // Cek apakah peserta memiliki pendaftaran
        if ($peserta->pendaftarans()->count() > 0) {
            return redirect()->route('peserta.index')->with('error', 'Tidak dapat menghapus peserta yang sudah terdaftar di kelas');
        }
        
        $peserta->delete();
        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus');
    }
}