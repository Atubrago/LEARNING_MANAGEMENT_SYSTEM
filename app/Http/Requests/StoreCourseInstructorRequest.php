<?php

namespace App\Http\Requests;

use App\Models\CourseInstructor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCourseInstructorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_instructor_create');
    }

    public function rules()
    {
        return [
            'instructor_id' => [
                'required',
                'integer',
            ],
            'course_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
