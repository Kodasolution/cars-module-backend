<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarqueStoreRequest extends FormRequest
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
        return
            [
            'marque' => 'required|unique:marque|max:255',
            "logo_marque"=>"required|file"
        ];
    }
}
