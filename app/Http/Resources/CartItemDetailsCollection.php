<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemDetailsCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'item_id'=>$this->item_id  ?? '',
          'box_id'=>$this->box_id  ?? '',
          'qty'=>$this->quantity ?? '',
          'price'=>$this->price ?? '',
        ];
    }
}
