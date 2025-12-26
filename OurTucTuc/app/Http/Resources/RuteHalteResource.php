<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RuteHalteResource extends JsonResource
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
            'jam_berangkat' => $this->jam_berangkat,

            'rute' => [
                'id' => $this->rute->id,
                'nama_rute' => $this->rute->nama_rute,
            ],

            'halte' => [
                'id' => $this->halte->id,
                'nama_halte' => $this->halte->nama_halte,
            ],

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
