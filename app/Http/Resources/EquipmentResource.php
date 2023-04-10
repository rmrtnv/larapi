<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\EquipmentTypeResource;
use App\Models\Equipment;
use App\Models\EquipmentType;


class EquipmentResource extends JsonResource
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
            'equipment_type' => EquipmentTypeResource::make($this->type),
            'serial_number' => $this->serial_number,
            'desc' => $this->comment,
        ];
    }
}
