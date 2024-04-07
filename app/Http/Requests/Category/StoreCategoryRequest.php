<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
class StoreCategoryRequest extends FormRequest
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
        'category_name_' . FL => 'required|string|unique:categories',
        'category_name_' . SL => 'required|string|unique:categories',
        'category_description_' . FL => 'required|string',
        'category_description_' . SL => 'required|string',
        'is_active' => 'boolean',
     ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'is_active' => (bool) $this->is_active,
            'created_by' => Auth()->id()
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
