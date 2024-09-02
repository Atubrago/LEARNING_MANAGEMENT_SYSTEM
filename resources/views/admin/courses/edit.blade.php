@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.course.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.courses.update", [$course->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.course.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $course->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.course.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', $course->description) }}">
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('requirement') ? 'has-error' : '' }}">
                            <label for="requirement">{{ trans('cruds.course.fields.requirement') }}</label>
                            <input class="form-control" type="text" name="requirement" id="requirement" value="{{ old('requirement', $course->requirement) }}">
                            @if($errors->has('requirement'))
                                <span class="help-block" role="alert">{{ $errors->first('requirement') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.requirement_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('level') ? 'has-error' : '' }}">
                            <label for="level_id">{{ trans('cruds.course.fields.level') }}</label>
                            <select class="form-control select2" name="level_id" id="level_id">
                                @foreach($levels as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('level_id') ? old('level_id') : $course->level->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('level'))
                                <span class="help-block" role="alert">{{ $errors->first('level') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.level_helper') }}</span>
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