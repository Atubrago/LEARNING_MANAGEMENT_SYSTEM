@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.user.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $user->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.email_verified_at') }}
                                    </th>
                                    <td>
                                        {{ $user->email_verified_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.roles') }}
                                    </th>
                                    <td>
                                        @foreach($user->roles as $key => $roles)
                                            <span class="label label-info">{{ $roles->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
                        <a href="#instructor_course_instructors" aria-controls="instructor_course_instructors" role="tab" data-toggle="tab">
                            {{ trans('cruds.courseInstructor.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#author_notices" aria-controls="author_notices" role="tab" data-toggle="tab">
                            {{ trans('cruds.notice.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#student_course_students" aria-controls="student_course_students" role="tab" data-toggle="tab">
                            {{ trans('cruds.courseStudent.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="instructor_course_instructors">
                        @includeIf('admin.users.relationships.instructorCourseInstructors', ['courseInstructors' => $user->instructorCourseInstructors])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="author_notices">
                        @includeIf('admin.users.relationships.authorNotices', ['notices' => $user->authorNotices])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="student_course_students">
                        @includeIf('admin.users.relationships.studentCourseStudents', ['courseStudents' => $user->studentCourseStudents])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection