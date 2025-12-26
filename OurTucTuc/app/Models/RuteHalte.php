<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rute;
use App\Models\Halte;

class RuteHalte extends Model
{
    protected $table ="rute_halte";

    protected $fillable = [
        'id_rute',
        'id_halte',
        'jam_berangkat'
    ];

      public function rute()
    {
        return $this->belongsTo(Rute::class, 'id_rute');
    }

    public function halte()
    {
        return $this->belongsTo(Halte::class, 'id_halte');
    }
}
