<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'amount_type' => 'required|in:0,1',
            'amount' => [(request()->amount_type == 0) ? 'max:100' : '', 'required', 'numeric'],
            'discount_ceiling' => 'nullable|min:1|max:100000000000|numeric',
            'type' => 'required|numeric|in:0,1',
            'status' => 'required|numeric|in:0,1,2',
            'start_date' => 'required|date_format:Y-m-d H:i',
            'end_date' => 'required|date_format:Y-m-d H:i|after_or_equal:start_date',
            'user_id' => 'required_if:type,1|numeric|regex:/^[0-9]+$/u|exists:users,id',
        ];
    }
}
