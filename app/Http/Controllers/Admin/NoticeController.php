<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNoticeRequest;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Models\Course;
use App\Models\Notice;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class NoticeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('notice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notices = Notice::with(['author', 'course', 'media'])->get();

        $users = User::get();

        $courses = Course::get();

        return view('admin.notices.index', compact('courses', 'notices', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('notice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.notices.create', compact('authors', 'courses'));
    }

    public function store(StoreNoticeRequest $request)
    {
        $notice = Notice::create($request->all());

        if ($request->input('file', false)) {
            $notice->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $notice->id]);
        }

        return redirect()->route('admin.notices.index');
    }

    public function edit(Notice $notice)
    {
        abort_if(Gate::denies('notice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $notice->load('author', 'course');

        return view('admin.notices.edit', compact('authors', 'courses', 'notice'));
    }

    public function update(UpdateNoticeRequest $request, Notice $notice)
    {
        $notice->update($request->all());

        if ($request->input('file', false)) {
            if (! $notice->file || $request->input('file') !== $notice->file->file_name) {
                if ($notice->file) {
                    $notice->file->delete();
                }
                $notice->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($notice->file) {
            $notice->file->delete();
        }

        return redirect()->route('admin.notices.index');
    }

    public function show(Notice $notice)
    {
        abort_if(Gate::denies('notice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notice->load('author', 'course');

        return view('admin.notices.show', compact('notice'));
    }

    public function destroy(Notice $notice)
    {
        abort_if(Gate::denies('notice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notice->delete();

        return back();
    }

    public function massDestroy(MassDestroyNoticeRequest $request)
    {
        $notices = Notice::find(request('ids'));

        foreach ($notices as $notice) {
            $notice->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('notice_create') && Gate::denies('notice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Notice();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
