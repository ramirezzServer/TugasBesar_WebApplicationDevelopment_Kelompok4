<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rute extends Model
{
    //
        use HasFactory;
         protected $table = 'rute';

    protected $fillable = [
        'nama_rute'
    ];
    public function rute_halte()
    {
        return $this->hasMany(RuteHalte::class, 'id_rute');
    }

    // relasi many-to-many ke halte
    public function haltes()
    {
        return $this->belongsToMany(
            Halte::class,
            'rute_halte',
            'id_rute',
            'id_halte'
        )
        ->withPivot('jam_berangkat')
        ->withTimestamps();
    }
}

