<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'warehouse_id'=>'required|integer',
            'address'=>'required|string',
            'received_date'=>'required|date',
            'received_time'=>'required',
            'payment_method'=>'required|string',
            'shipment_method'=>'required|string',
        ];
    }
}
