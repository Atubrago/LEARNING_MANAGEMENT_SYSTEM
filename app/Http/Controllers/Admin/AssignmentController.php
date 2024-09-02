<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAssignmentRequest;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Models\Assignment;
use App\Models\Lesson;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AssignmentController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('assignment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignments = Assignment::with(['lesson', 'media'])->get();

        $lessons = Lesson::get();

        return view('admin.assignments.index', compact('assignments', 'lessons'));
    }

    public function create()
    {
        abort_if(Gate::denies('assignment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.assignments.create', compact('lessons'));
    }

    public function store(StoreAssignmentRequest $request)
    {
        $assignment = Assignment::create($request->all());

        if ($request->input('file', false)) {
            $assignment->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $assignment->id]);
        }

        return redirect()->route('admin.assignments.index');
    }

    public function edit(Assignment $assignment)
    {
        abort_if(Gate::denies('assignment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assignment->load('lesson');

        return view('admin.assignments.edit', compact('assignment', 'lessons'));
    }

    public function update(UpdateAssignmentRequest $request, Assignment $assignment)
    {
        $assignment->update($request->all());

        if ($request->input('file', false)) {
            if (! $assignment->file || $request->input('file') !== $assignment->file->file_name) {
                if ($assignment->file) {
                    $assignment->file->delete();
                }
                $assignment->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($assignment->file) {
            $assignment->file->delete();
        }

        return redirect()->route('admin.assignments.index');
    }

    public function show(Assignment $assignment)
    {
        abort_if(Gate::denies('assignment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignment->load('lesson');

        return view('admin.assignments.show', compact('assignment'));
    }

    public function destroy(Assignment $assignment)
    {
        abort_if(Gate::denies('assignment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssignmentRequest $request)
    {
        $assignments = Assignment::find(request('ids'));

        foreach ($assignments as $assignment) {
            $assignment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('assignment_create') && Gate::denies('assignment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Assignment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
