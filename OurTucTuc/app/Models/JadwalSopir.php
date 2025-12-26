<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalSopir extends Model
{
    use HasFactory;
    protected $table = 'jadwalSopirs';
    protected $fillable = [
        'id_sopir', 'nama_sopir', 'id_rute_halte', 'nama_rute', 'jam_mulai', 'jam_selesai','status'
    ];
}
