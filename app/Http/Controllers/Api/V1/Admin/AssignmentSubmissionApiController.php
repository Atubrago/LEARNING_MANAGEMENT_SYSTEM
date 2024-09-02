<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAssignmentSubmissionRequest;
use App\Http\Requests\UpdateAssignmentSubmissionRequest;
use App\Http\Resources\Admin\AssignmentSubmissionResource;
use App\Models\AssignmentSubmission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssignmentSubmissionApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('assignment_submission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssignmentSubmissionResource(AssignmentSubmission::with(['assignment', 'student'])->get());
    }

    public function store(StoreAssignmentSubmissionRequest $request)
    {
        $assignmentSubmission = AssignmentSubmission::create($request->all());

        if ($request->input('file', false)) {
            $assignmentSubmission->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        return (new AssignmentSubmissionResource($assignmentSubmission))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AssignmentSubmission $assignmentSubmission)
    {
        abort_if(Gate::denies('assignment_submission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssignmentSubmissionResource($assignmentSubmission->load(['assignment', 'student']));
    }

    public function update(UpdateAssignmentSubmissionRequest $request, AssignmentSubmission $assignmentSubmission)
    {
        $assignmentSubmission->update($request->all());

        if ($request->input('file', false)) {
            if (! $assignmentSubmission->file || $request->input('file') !== $assignmentSubmission->file->file_name) {
                if ($assignmentSubmission->file) {
                    $assignmentSubmission->file->delete();
                }
                $assignmentSubmission->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($assignmentSubmission->file) {
            $assignmentSubmission->file->delete();
        }

        return (new AssignmentSubmissionResource($assignmentSubmission))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AssignmentSubmission $assignmentSubmission)
    {
        abort_if(Gate::denies('assignment_submission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignmentSubmission->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
