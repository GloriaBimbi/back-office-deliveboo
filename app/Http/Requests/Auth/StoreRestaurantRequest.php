<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
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
            'description' => ['string','max:1000'],
            'name' => ['required','string', 'max:75'],

            'address_street' => ['required','string','max:255'],
            'address_civic' => ['required','string','max:10'],
            'address_postal_code' => ['required','string','max:5' , 'min:5'],
            'address_city' => ['required','string','max:100'],
            'address_country' => ['required','string','max:100'],

            'piva' => ['required','unique:restaurants', 'string', 'max:11','min:11'],
            'image' => ['image', 'required'],
            'slug' => ['required','string','max:150', 'unique:restaurants'],
            'types' => ['required','exists:types,id'],
        ];
    }
}
