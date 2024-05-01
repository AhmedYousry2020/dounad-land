<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'sub_total' => $this->subTotal(),
          'tax' => 10.00,
          'shipping_cost' => 0.00,
          'discount' => 0.00,
          'grand_total' => $this->grandTotal()

        ];
    }
}
