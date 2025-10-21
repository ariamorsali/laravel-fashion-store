<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductAttributeValueRequest extends FormRequest
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
            'value' => 'required|string|min:1|max:120|regex:/^[ا-یa-zA-Z0-9\-\۰-۹ء-ي.,\s]+$/u',
            'product_id' => 'required|min:1|max:100000000|integer|exists:products,id',
        ];
    }
}
