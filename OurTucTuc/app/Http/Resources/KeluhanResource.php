<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KeluhanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'id_penumpang' => $this->id_penumpang,
            'nama_keluhan' => $this->nama_keluhan,
            'status' => $this->status,
            'created_at' => optional($this->created_at)->toISOString(),
            'updated_at' => optional($this->updated_at)->toISOString(),

            'penumpang' => $this->whenLoaded('penumpang', function () {
                return [
                    'id' => $this->penumpang->id,
                    'name' => $this->penumpang->name,
                    'email' => $this->penumpang->email,
                    'NoTelp' => $this->penumpang->NoTelp,
                ];
            }),
        ];
    }
}
