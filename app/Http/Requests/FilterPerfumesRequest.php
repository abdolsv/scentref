<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterPerfumesRequest extends FormRequest
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
            'brand_ids'           => ['nullable', 'array'],
            'brand_ids.*'         => ['integer', 'exists:brands,id'],
            'scent_family_ids'    => ['nullable', 'array'],
            'scent_family_ids.*'  => ['integer', 'exists:scent_families,id'],
            'gender'              => ['nullable', 'in:men,women,unisex'],
            'concentration'       => ['nullable', 'array'],
            'concentration.*'     => ['in:parfum,edp,edt,edc,body_spray,oil'],
            'price_min'           => ['nullable', 'numeric', 'min:0'],
            'price_max'           => ['nullable', 'numeric', 'min:0'],
            'occasion'            => ['nullable', 'string', 'max:50'],
            'note_ids'            => ['nullable', 'array'],
            'note_ids.*'          => ['integer', 'exists:notes,id'],
            'longevity_min'       => ['nullable', 'integer', 'min:1', 'max:10'],
            'availability'        => ['nullable', 'in:available,import_only,not_available'],
            'verdict'             => ['nullable', 'in:must_buy,highly_recommended,recommended,worth_trying,skip'],
            'sort'                => ['nullable', 'in:rating,price_asc,price_desc,newest,longevity'],
            'q'                   => ['nullable', 'string', 'max:200'],
        ];
    }
}
