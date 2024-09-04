<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class UpdateFileRequest extends FormRequest
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
        $fileId = request('file')->id;
        return [
            'title' => 'string|required|unique:files,title,' . $fileId,
            'description' => 'string|required',
            'file' => 'file|mimes:png,jpg,pdf,docx,xls,xlsx'
        ];
    }
}
