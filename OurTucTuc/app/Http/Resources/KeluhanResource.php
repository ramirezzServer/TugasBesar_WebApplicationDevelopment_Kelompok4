<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KeluhanResource extends JsonResource
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
            'nama_keluhan' => $this->nama_keluhan,
            'status' => $this->status,
            'id_penumpang' => $this->id_penumpang,
            'created_at' => optional($this->created_at)->toISOString(),
            'updated_at' => optional($this->updated_at)->toISOString(),

            // join data penumpang (muncul kalau controller pakai with('penumpang'))
            'penumpang' => $this->whenLoaded('penumpang', function () {
                return [
                    'id' => $this->penumpang->id,
                    'name' => $this->penumpang->name,
                    'email' => $this->penumpang->email,
                    'NoTelp' => $this->penumpang->NoTelp,
                ];
            }),

            'nama_pengaju' => $this->whenLoaded('penumpang', fn () => $this->penumpang->name),
        ];
    }
}
