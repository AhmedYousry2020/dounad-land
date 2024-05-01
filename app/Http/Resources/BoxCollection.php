<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoxCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          "box_name"=>$this->{'box_name_'. SL} ?? '',
          "box_description"=>$this->{'description_'. SL} ?? '',
          "price"=>$this->price ?? '',
          "num of items"=>$this->num_of_items ?? '',
          "box_items"=> BoxItemCollection::collection($this->items) ?? ''
        ];
    }
}
