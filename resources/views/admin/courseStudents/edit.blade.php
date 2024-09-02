@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.courseStudent.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.course-students.update", [$courseStudent->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('course') ? 'has-error' : '' }}">
                            <label class="required" for="course_id">{{ trans('cruds.courseStudent.fields.course') }}</label>
                            <select class="form-control select2" name="course_id" id="course_id" required>
                                @foreach($courses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('course_id') ? old('course_id') : $courseStudent->course->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('course'))
                                <span class="help-block" role="alert">{{ $errors->first('course') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.courseStudent.fields.course_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('student') ? 'has-error' : '' }}">
                            <label class="required" for="student_id">{{ trans('cruds.courseStudent.fields.student') }}</label>
                            <select class="form-control select2" name="student_id" id="student_id" required>
                                @foreach($students as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('student_id') ? old('student_id') : $courseStudent->student->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('student'))
                                <span class="help-block" role="alert">{{ $errors->first('student') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.courseStudent.fields.student_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection