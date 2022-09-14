<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'            => 'nullable',
            'isbn'            => 'nullable',
            'authors'         => 'nullable',
            'country'         => 'nullable',
            'number_of_pages' => 'nullable',
            'publisher'       => 'nullable',
            'release_date'    => 'nullable'
        ];
    }
}
