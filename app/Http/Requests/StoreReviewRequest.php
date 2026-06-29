<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'reviewer_name'      => ['required', 'string', 'max:100'],
            'reviewer_email'     => ['nullable', 'email', 'max:255'],
            'reviewer_city'      => ['nullable', 'string', 'max:100'],
            'reviewer_climate'   => ['required', 'in:hot_outdoor,ac_office,cool_evening,harmattan'],
            'rating_overall'     => ['required', 'integer', 'min:1', 'max:10'],
            'rating_longevity'   => ['nullable', 'integer', 'min:1', 'max:10'],
            'rating_sillage'     => ['nullable', 'integer', 'min:1', 'max:10'],
            'rating_value'       => ['nullable', 'integer', 'min:1', 'max:10'],
            'purchase_source'    => ['nullable', 'string', 'max:200'],
            'purchase_price_ngn' => ['nullable', 'numeric', 'min:0'],
            'review_title'       => ['nullable', 'string', 'max:200'],
            'review_body'        => ['required', 'string', 'min:50', 'max:5000'],
        ];
    }
}
