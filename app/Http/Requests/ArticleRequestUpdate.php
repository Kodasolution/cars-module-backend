<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequestUpdate extends FormRequest
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
        return [
            "nom_article"=>'required', Rule::unique('articles')->ignore($this->nom_article),
            "prix_article"=>"required",
            "type_article"=>"required",
            "entreprise_id"=>"required",
            "slug_nom_article"=>"",
            "actif"=>"",
            "nombre_view"=>""
        ];
    }
}
