<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ruteResource extends JsonResource
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
            'nama_rute' => $this->nama_rute,

            'halte' => $this->whenLoaded('haltes', function () {
                return $this->haltes->map(function ($halte) {
                    return [
                        'id' => $halte->id,
                        'nama_halte' => $halte->nama_halte,
                        'jam_berangkat' => $halte->pivot->jam_berangkat
                    ];
                });
            }),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
