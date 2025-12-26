<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JadwalSopirResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'jam_mulai' => $this->jam_mulai,
        'jam_selesai' => $this->jam_selesai,
        'status' => $this->status,

        'sopir' => [
            'id' => $this->sopir?->id,
            'nama_sopir' => $this->sopir?->nama_sopir,
        ],

        'kendaraan' => [
            'id' => $this->kendaraan?->id,
        ],

        'ruteHalte' => [
            'id' => $this->ruteHalte?->id,
            'jam_berangkat' => $this->ruteHalte?->jam_berangkat,
        ],
    ];
}

}
