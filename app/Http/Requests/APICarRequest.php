<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class APICarRequest extends FormRequest
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
        //creamos el request con php artisan make:request APICarRequest para que validemos los datos de la API
        return [
            "plate" => "required",
            "marca" => "required",
            "model" => "required"
        ];
    }
}
