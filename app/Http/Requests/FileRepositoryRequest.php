<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRepositoryRequest extends FormRequest
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
            'degree' => 'required',
            'year' => 'required',
            'semester' => 'required',
            'session' => 'required|string|max:11',
            'title' => 'required|string|max:255|min:4',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'uploadYear'=>'required|digits:4|integer|min:1900|max:' . (date('Y'))

        ];
    }

    public function messages()
{
    return [
        'degree.required' => 'Degree must be select',
        'year.required' => 'Year must be select',
        'semester.required' => 'Semester must be select',
        'file.required' => 'A file is required.',
        'file.mimes' => 'The file must be an PDF, or an Office document (Word, Excel).',
    ];
}
}
