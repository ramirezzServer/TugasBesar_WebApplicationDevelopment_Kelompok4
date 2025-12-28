<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalSopir extends Model
{
    use HasFactory;

    protected $table = 'jadwal_sopir';

    protected $fillable = [
        'jam_mulai',
        'jam_selesai',
        'id_kendaraan',
        'id_sopir',
        'id_rute_halte',
        'status',
    ];

    public function sopir()
    {
        return $this->belongsTo(Sopir::class, 'id_sopir');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }

    public function ruteHalte()
    {
        return $this->belongsTo(RuteHalte::class, 'id_rute_halte');
    }
}
