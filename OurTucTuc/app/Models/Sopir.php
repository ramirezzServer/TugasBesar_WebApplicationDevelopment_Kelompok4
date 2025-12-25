<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sopir extends Model
{
    protected $table = "sopirs";

    protected $fillable = [
        'nama_sopir',
        'notelp_sopir',
        'alamat',
        'email_sopir',
        'foto',
    ];


}
