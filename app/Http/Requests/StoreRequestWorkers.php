<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestWorkers extends FormRequest
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
            'name'        => 'required',
            'hiring' => 'required',
            'birth'  =>'required',
            'gender'      => 'required',
            'email'      =>'required|email',
            'number'      =>'required',
            'adress'      =>'required'
        ];
    }
}
