<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAssignmentSubmissionRequest;
use App\Http\Requests\StoreAssignmentSubmissionRequest;
use App\Http\Requests\UpdateAssignmentSubmissionRequest;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AssignmentSubmissionController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('assignment_submission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $isStudent = Auth::user()->roles->first()->title;
        if ($isStudent == 'Student') {
        $assignmentSubmissions = AssignmentSubmission::with(['assignment', 'student', 'media'])->where('student_id', Auth::id())->get();

        $assignments = Assignment::get();

        $users = User::get();

        return view('admin.assignmentSubmissions.index', compact('assignmentSubmissions', 'assignments', 'users'));
        }else{
            $assignmentSubmissions = AssignmentSubmission::with(['assignment', 'student', 'media'])->get();

        $assignments = Assignment::get();

        $users = User::get();

        return view('admin.assignmentSubmissions.index', compact('assignmentSubmissions', 'assignments', 'users'));
        }

        
    }

    public function create()
    {
        abort_if(Gate::denies('assignment_submission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignments = Assignment::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.assignmentSubmissions.create', compact('assignments', 'students'));
    }

    public function store(StoreAssignmentSubmissionRequest $request)
    {
        $assignmentSubmission = AssignmentSubmission::create($request->all());

        if ($request->input('file', false)) {
            $assignmentSubmission->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $assignmentSubmission->id]);
        }

        return redirect()->route('admin.assignment-submissions.index');
    }

    public function edit(AssignmentSubmission $assignmentSubmission)
    {
        abort_if(Gate::denies('assignment_submission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignments = Assignment::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assignmentSubmission->load('assignment', 'student');

        return view('admin.assignmentSubmissions.edit', compact('assignmentSubmission', 'assignments', 'students'));
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

        return redirect()->route('admin.assignment-submissions.index');
    }

    public function show(AssignmentSubmission $assignmentSubmission)
    {
        abort_if(Gate::denies('assignment_submission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignmentSubmission->load('assignment', 'student');

        return view('admin.assignmentSubmissions.show', compact('assignmentSubmission'));
    }

    public function destroy(AssignmentSubmission $assignmentSubmission)
    {
        abort_if(Gate::denies('assignment_submission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignmentSubmission->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssignmentSubmissionRequest $request)
    {
        $assignmentSubmissions = AssignmentSubmission::find(request('ids'));

        foreach ($assignmentSubmissions as $assignmentSubmission) {
            $assignmentSubmission->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('assignment_submission_create') && Gate::denies('assignment_submission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AssignmentSubmission();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
