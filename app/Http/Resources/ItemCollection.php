<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'id'=>$this->id ?? '',
          'item_name'=>$this->{'item_name_'. SL} ?? '',
          'item_slug'=>$this->{'item_slug'} ?? '',
          'description'=>$this->{'description_'. SL} ?? '',
          'price'=>$this->price ?? '',
          'qty_available'=>$this->qty_available ?? '',
          'category'=>new CategoryCollection($this->category)
        ];
    }
}
