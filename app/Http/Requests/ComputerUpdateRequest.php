<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ComputerUpdateRequest extends FormRequest
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
            'pc_name' => 'unique:App\Models\Computer,pc_name',
            'ip' => 'ipv4|unique:App\Models\Computer,ip',
        ];
    }

     public function failedValidation($validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }



    public function messages()
    {
        return [
            // 'pc_name.required' => 'pc_name is required',
            // 'pc_name.unique' => 'pc lo double blok'
        ];
    }
}
