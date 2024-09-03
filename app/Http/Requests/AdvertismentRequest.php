<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertismentRequest extends FormRequest
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
            "ar_advertisement"=>"required|string",
            "en_advertisement"=>"nullable|string",
            "ar_details"=>"required|string",
            "en_details"=>"nullable|string",
            "archieve"=>"nullable|boolean",
        ];
    }
}
