<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffFormRequest extends FormRequest
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
            'address'=>'string|required',
            'post_town'=>'string|required',
            'post_code'=>'string|required',
            'cv_file'=>'file|required',
            'supporting_statement'=>'string',
            'job_title'=>'array|required|min:1',
            'job_title.*'=>'string|required',
            'company_name'=>'array|required|min:1',
            'company_name.*'=>'string|required',
            'job_start_date'=>'array|required|min:1',
            'job_start_date.*'=>'date|required',
            'job_end_date'=>'array|required|min:1',
            'job_end_date.*'=>'date|required',
            'job_end_date'=>'array|required|min:1',
            'job_end_date.*'=>'date|required',
            'job_details'=>'array|required|min:1',
            'job_details.*'=>'string|required',

            'referee_name'=>'array|required|min:1',
            'referee_name.*'=>'string|required|min:1',
            'referee_company_name'=>'array|required|min:1',
            // 'referee_company_name.*'=>'string|required',
            'referee_job_title'=>'array|required|min:1',
            // 'referee_job_title.*'=>'string|required',
            'referee_email'=>'array|required|min:1',
            'referee_email.*'=>'string|required',
            'adult_cautions'=>'string|required',
            'barred_from_children'=>'string|required',
            'child_court_protection'=>'string|required',
            'adult_court_protection'=>'string|required',
            'childcare_cancellation'=>'string|required',
            'residential_cancellation'=>'string|required',
            'teaching_prohibition'=>'string|required',
            'adult_prohibition'=>'string|required',
            'barred_by_employer'=>'string|required',
            'barred_by_professional_body'=>'string|required',
            'declaration_details'=>'string|required',            
        ];
    }
}
