<?php

namespace App\Http\Requests;

use App\Models\Restaurant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestaurantUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'restaurant' => ['required', 'string', 'max:255'],
            'table' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string'],
            'status' => ['required', 'string'],
        ];
    }
}
