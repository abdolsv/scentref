<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePriceAlertRequest extends FormRequest
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
            'perfume_id'   => ['required', 'integer', 'exists:perfumes,id'],
            'email'        => ['required', 'email', 'max:255'],
            'target_price' => ['required', 'numeric', 'min:1'],
        ];
    }
}
