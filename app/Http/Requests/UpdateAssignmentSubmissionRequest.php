<?php

namespace App\Http\Requests;

use App\Models\AssignmentSubmission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAssignmentSubmissionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('assignment_submission_edit');
    }

    public function rules()
    {
        return [
            'assignment_id' => [
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
