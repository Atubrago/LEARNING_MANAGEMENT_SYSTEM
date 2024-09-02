@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.lesson.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.lessons.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $lesson->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.course') }}
                                    </th>
                                    <td>
                                        {{ $lesson->course->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $lesson->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.desctiption') }}
                                    </th>
                                    <td>
                                        {!! $lesson->desctiption !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.content') }}
                                    </th>
                                    <td>
                                        {!! $lesson->content !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.file') }}
                                    </th>
                                    <td>
                                        @foreach($lesson->file as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.lessons.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#lesson_assignments" aria-controls="lesson_assignments" role="tab" data-toggle="tab">
                            {{ trans('cruds.assignment.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="lesson_assignments">
                        @includeIf('admin.lessons.relationships.lessonAssignments', ['assignments' => $lesson->lessonAssignments])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection