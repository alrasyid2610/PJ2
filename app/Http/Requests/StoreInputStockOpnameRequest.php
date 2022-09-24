<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreInputStockOpnameRequest extends FormRequest
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

    public function failedValidation($validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user.email' => 'email',
            "user.name" => 'required',
            "user.section" => 'required',
            "user.factory" => "required",

            // computer validation
            'computer.pc_name' => 'required|unique:App\Models\Computer,pc_name',
            "computer.processor" => "required",
            "computer.os" => "required",
            "computer.ram" => "required",
            "computer.hdd" => "required",
            'computer.ip' => 'required|ipv4|unique:App\Models\Computer,ip',
            "computer.ms_office" => "required",
            "computer.antivirus" => "required",
            "computer.wsus" => "required",
            "computer.user_login" => "required",
            "computer.brand" => "required",
            "computer.usage_type" => "required",
            "computer.status_fix_asset" => "required",
        ];
    }
}
