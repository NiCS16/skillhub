<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = ['peserta_id', 'kelas_id', 'tanggal_daftar'];

    protected $casts = [
        'tanggal_daftar' => 'date'
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}