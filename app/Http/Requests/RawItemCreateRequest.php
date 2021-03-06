<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RawItemCreateRequest extends FormRequest
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
            'name' => 'bail|required|max:100|unique:raw_items',
            'description' => 'required|max:200',
            'unit_id' => 'required',
            'stock' => 'required|numeric',
        ];
    }
}
