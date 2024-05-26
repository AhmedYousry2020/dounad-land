<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class RemoveItemFromCartRequest extends FormRequest
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
        $rules = ['type'=>'required'];
        if($this->type == 'box')
        {
          array_merge($rules,['box_id'=>'required|integer']);
        }else
        {
          array_merge($rules,['item_id'=>'required|integer']);
        }
        return $rules;
    }
}
