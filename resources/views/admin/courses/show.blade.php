@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.course.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $course->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $course->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $course->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.requirement') }}
                                    </th>
                                    <td>
                                        {{ $course->requirement }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.level') }}
                                    </th>
                                    <td>
                                        {{ $course->level->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
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
                        <a href="#course_lessons" aria-controls="course_lessons" role="tab" data-toggle="tab">
                            {{ trans('cruds.lesson.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#course_course_instructors" aria-controls="course_course_instructors" role="tab" data-toggle="tab">
                            {{ trans('cruds.courseInstructor.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#course_notices" aria-controls="course_notices" role="tab" data-toggle="tab">
                            {{ trans('cruds.notice.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="course_lessons">
                        @includeIf('admin.courses.relationships.courseLessons', ['lessons' => $course->courseLessons])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="course_course_instructors">
                        @includeIf('admin.courses.relationships.courseCourseInstructors', ['courseInstructors' => $course->courseCourseInstructors])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="course_notices">
                        @includeIf('admin.courses.relationships.courseNotices', ['notices' => $course->courseNotices])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection