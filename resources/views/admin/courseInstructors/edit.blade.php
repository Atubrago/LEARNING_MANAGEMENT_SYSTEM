@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.courseInstructor.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.course-instructors.update", [$courseInstructor->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('instructor') ? 'has-error' : '' }}">
                            <label class="required" for="instructor_id">{{ trans('cruds.courseInstructor.fields.instructor') }}</label>
                            <select class="form-control select2" name="instructor_id" id="instructor_id" required>
                                @foreach($instructors as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('instructor_id') ? old('instructor_id') : $courseInstructor->instructor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('instructor'))
                                <span class="help-block" role="alert">{{ $errors->first('instructor') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.courseInstructor.fields.instructor_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('course') ? 'has-error' : '' }}">
                            <label class="required" for="course_id">{{ trans('cruds.courseInstructor.fields.course') }}</label>
                            <select class="form-control select2" name="course_id" id="course_id" required>
                                @foreach($courses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('course_id') ? old('course_id') : $courseInstructor->course->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('course'))
                                <span class="help-block" role="alert">{{ $errors->first('course') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.courseInstructor.fields.course_helper') }}</span>
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