<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeatherRequest extends FormRequest
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
            "city" => "required|max:255",
            "temperature" => "required|max:255",
            "wind" => "required|max:255",
            "humidity" => "required|max:255",
            "pressure" => "required|max:255",
            "date" => "date",
        ];
    }
}
