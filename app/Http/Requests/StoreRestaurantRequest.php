<?php

namespace App\Http\Requests;

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
            'address' => ['required','string','max:255'],
            // Da sistemare max e min
            'piva' => ['required','unique:restaurants', 'string', 'max:11','min:11'],
            // Controllare che indirizzo immagine sia text o altro
            'image' => ['image', 'max:120'],
            'slug' => ['required','string','max:150', 'unique:restaurants'],
        ];
    }
}
