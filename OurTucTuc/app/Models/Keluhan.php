<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    protected $table = 'keluhan';

    protected $fillable = [
        'id_penumpang',
        'nama_keluhan',
        'status',
    ];

    public function penumpang()
    {
        return $this->belongsTo(User::class, 'id_penumpang');
    }
}
