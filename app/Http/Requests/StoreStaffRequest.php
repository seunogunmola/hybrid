<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffRequest extends FormRequest
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
            'firstname'=>'string|required',
            'lastname'=>'string|required',
            'email'=>'email|required|unique:users',
            'phone'=>'string|required|unique:users',
            'password'=>'string|required|confirmed',
            'username'=>'string|required|unique:users',
            'pin'=>'string'
        ];
    }
}
