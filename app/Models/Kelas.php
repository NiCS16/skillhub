<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelas', 'deskripsi', 'instruktur'];

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function pesertas()
    {
        return $this->belongsToMany(Peserta::class, 'pendaftarans')
                    ->withPivot('tanggal_daftar') // TAMBAHKAN INI
                    ->withTimestamps();
    }
}