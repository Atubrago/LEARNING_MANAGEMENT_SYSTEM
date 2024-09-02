<?php

namespace App\Http\Requests;

use App\Models\AssignmentSubmission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAssignmentSubmissionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('assignment_submission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:assignment_submissions,id',
        ];
    }
}
