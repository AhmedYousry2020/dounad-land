<?php

namespace App\Http\Requests\Item;


use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class StoreItemRequest extends FormRequest
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
        'item_name_' . FL => 'required|string|unique:items',
        'item_name_' . SL => 'required|string|unique:items',
        'description_' . FL => 'required|string',
        'description_' . SL => 'required|string',
        'item_slug' => 'required|string',
        'item_image' => 'required|file',
        'category_id' => 'required|integer',
        'is_active' => 'boolean',
     ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'is_active' => (bool) $this->is_active
        ]);
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        info($validator->errors());
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}

