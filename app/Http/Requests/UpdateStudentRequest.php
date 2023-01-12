<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'student_name' => 'required|max:11|min:2|alpha',
            'student_surname' => 'required|max:64|min:2|alpha',
            'student_email' => 'required|email',
            'student_avg_grade' => 'required|integer|min:1|max:100',
        ];
}
