<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          "id"=>$this->id ?? '',
          "warehouse_name"=>$this->{'warehouse_name_'. getLocale()} ?? '',
          "address"=>$this->address ?? '',
          "phone_number"=>$this->phone_number ?? '',
          "word_from"=>$this->word_from ?? '',
          "word_end"=>$this->word_end ?? '',
          "delivery_from"=>$this->delivery_from ?? '',
          "delivery_to"=>$this->delivery_to ?? '',
          "is_active"=>$this->is_active ?? '',
        ];
    }
}
