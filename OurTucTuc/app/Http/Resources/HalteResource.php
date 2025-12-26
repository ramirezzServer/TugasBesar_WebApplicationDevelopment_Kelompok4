<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class halteResource extends JsonResource
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
            'nama_halte' => $this->nama_halte,

            'halte' => $this->whenLoaded('haltes', function () {
                return $this->haltes->map(function ($haltes) {
                    return [
                        'id' => $haltes->id,
                        'nama_halte' => $haltes->nama_halte,
                        'jam_berangkat' => $haltes->pivot->jam_berangkat
                    ];
                });
            })
        ];
    }
}
