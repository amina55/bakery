<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierCreateRequest extends FormRequest
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
        $rules = [
            'name' => 'bail|required|min:3|max:100',
            'address' => 'bail|required|min:3|max:200',
            //'phone_no' => 'bail|required|numeric|size:9',
            'phone_no' => 'required|regex:/[0-9]{9}/'
        ];

        if($this->attributes->get('request_type') == 'create') {
            $rules['identifier'] = 'bail|required|min:3|max:50|unique:suppliers';
        }
        return $rules;
    }
}
