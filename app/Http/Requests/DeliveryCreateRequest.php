<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryCreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'delivery_id' => [
                'required'
            ],
            'delivery_name_1' => [
                'required'
            ],
            'furigana_1' => [
                'required'
            ],
            'zipcode' => [
                'required'
            ],
            'province' => [
                'required'
            ],
            'city' => [
                'required'
            ],
            'town' => [
                'required'
            ],
            'phone' => [
                'required'
            ]
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'delivery_id.required' => 'delivery_id not blank',
            'delivery_name_1.required' => 'delivery_name_1 not blank',
            'furigana_1.required' => 'furigana_1 not blank',
            'zipcode.required' => 'zipcode not blank',
            'province.required' => 'province not blank',
            'city.required' => 'city not blank',
            'town.required' => 'town not blank',
            'phone.required' => 'phone not blank',
        ];
    }
}
