<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'order_code'=>$this->code ?? '',
          'user'=>$this->user->name ?? '',
          'sub_total' => $this->sub_total ?? '',
          'total_amount' => $this->total_amount ?? '',
          'tax'=>$this->tax ?? '',
          'order_status'=>$this->order_status ?? '',
          'shipment_status'=>$this->shipment_status ?? '',
          'payment_status'=>$this->payment_status ?? '',
          'items_count'=>$this->items_count ?? '',
          'payment_method'=>$this->payment_method ?? '',
          'shipment_method'=>$this->shipment_method ?? '',
          'warehouse'=>$this->warehouse->{'warehouse_name_'. getLocale()} ?? ''
        ];
    }
}
