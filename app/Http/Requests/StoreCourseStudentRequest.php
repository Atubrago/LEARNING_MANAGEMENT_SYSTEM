<?php

namespace App\Http\Requests;

use App\Models\CourseStudent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCourseStudentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_student_create');
    }

    public function rules()
    {
        return [
            'course_id' => [
                'required',
                'integer',
            ],
            'student_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
