<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Keluhan extends Model
{
    use HasFactory;

    protected $table = 'keluhan';

    protected $fillable = [
        'id_penumpang',
        'nama_keluhan',
        'status',
    ];

    /**
     * Relasi ke user (penumpang)
     */
    public function penumpang()
    {
        return $this->belongsTo(User::class, 'id_penumpang');
    }
}
