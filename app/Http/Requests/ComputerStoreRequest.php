<?php

namespace App\Http\Requests;

use App\Models\Computer;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ComputerStoreRequest extends FormRequest
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
            'pc_name' => 'required|unique:App\Models\Computer,pc_name',
            'processor' => 'required',
            'os' => 'required',
            'ram' => 'required',
            'hdd' => 'required',
            'ip' => 'required|ipv4|unique:App\Models\Computer,ip',
        ];
    }

     public function failedValidation(Validator $validator)
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
