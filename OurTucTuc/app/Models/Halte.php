<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class halte extends Model
{
    protected $table ="halte";

    protected $fillable = [
        'nama_halte'
    ];

      public function rutes()
    {
        return $this->belongsToMany(
            Rute::class,
            'rute_halte',
            'id_halte',
            'id_rute'
        )->withPivot('jam_berangkat')
         ->withTimestamps();
    }
}
