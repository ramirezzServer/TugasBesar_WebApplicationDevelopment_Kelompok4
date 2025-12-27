<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'NoTelp' => $this->NoTelp,
            'role' => $this->role,
            'email_verified_at' => optional($this->email_verified_at)->toISOString(),
            'created_at' => optional($this->created_at)->toISOString(),
            'updated_at' => optional($this->updated_at)->toISOString(),

            'keluhan' => $this->whenLoaded('keluhans', function () {
                return $this->keluhans->map(function ($k) {
                    return [
                        'id' => $k->id,
                        'nama_keluhan' => $k->nama_keluhan,
                        'status' => $k->status,
                        'created_at' => optional($k->created_at)->toISOString(),
                    ];
                });
            }),

            'keluhan_count' => $this->whenLoaded('keluhans', fn () => $this->keluhans->count()),
        ];
    }
}
