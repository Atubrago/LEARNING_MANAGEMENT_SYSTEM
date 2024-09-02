<?php

namespace App\Http\Requests;

use App\Models\CourseInstructor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCourseInstructorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('course_instructor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:course_instructors,id',
        ];
    }
}
