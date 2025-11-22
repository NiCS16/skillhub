<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'email', 'telepon', 'alamat'];

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'pendaftarans')
                    ->withPivot('tanggal_daftar') // TAMBAHKAN INI
                    ->withTimestamps();
    }
}