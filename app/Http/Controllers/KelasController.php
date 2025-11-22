<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'deskripsi' => 'required',
            'instruktur' => 'required'
        ]);

        Kelas::create($request->all());
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function show(Kelas $kela)
    {
        return view('kelas.show', compact('kela'));
    }

    public function edit(Kelas $kela)
    {
        return view('kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'deskripsi' => 'required',
            'instruktur' => 'required'
        ]);

        $kela->update($request->all());
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diupdate');
    }

    public function destroy(Kelas $kela)
    {
        // Cek apakah kelas memiliki peserta terdaftar
        if ($kela->pendaftarans()->count() > 0) {
            return redirect()->route('kelas.index')->with('error', 'Tidak dapat menghapus kelas yang sudah memiliki peserta');
        }
        
        $kela->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus');
    }
}