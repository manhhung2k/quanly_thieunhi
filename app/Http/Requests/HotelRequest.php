<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category,id',
            'code' => 'required',
            'price_max' => 'required|numeric|greater_than_field:price_min',
            'price_min' => 'required|numeric|less_than_field:price_max',
            'sale_day' => 'required|date|after:today',
        ];

        if (!$this->input('image_1')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:4096';
        }

        return $rules;
    }
}
