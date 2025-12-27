<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HalteResource extends JsonResource
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

            'rutes' => $this->whenLoaded('rutes', function () {
                return $this->rutes->map(function ($rute) {
                    return [
                        'id' => $rute->id,
                        'nama_rute' => $rute->nama_rute,
                        'jam_berangkat' => $rute->pivot->jam_berangkat
                    ];
                });
            })
        ];
    }
}
