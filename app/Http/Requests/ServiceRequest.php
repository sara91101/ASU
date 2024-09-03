<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            "service_ar"=>"required|string",
            "service_en"=>"nullable|string",
            "description_ar"=>"required|string",
            "description_en"=>"nullable|string",
            'price' => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ];
    }
}
