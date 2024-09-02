<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCourseInstructorRequest;
use App\Http\Requests\StoreCourseInstructorRequest;
use App\Http\Requests\UpdateCourseInstructorRequest;
use App\Models\Course;
use App\Models\CourseInstructor;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseInstructorController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('course_instructor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseInstructors = CourseInstructor::with(['instructor', 'course'])->get();

        $users = User::get();

        $courses = Course::get();

        return view('admin.courseInstructors.index', compact('courseInstructors', 'courses', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_instructor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instructors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.courseInstructors.create', compact('courses', 'instructors'));
    }

    public function store(StoreCourseInstructorRequest $request)
    {
        $courseInstructor = CourseInstructor::create($request->all());

        return redirect()->route('admin.course-instructors.index');
    }

    public function edit(CourseInstructor $courseInstructor)
    {
        abort_if(Gate::denies('course_instructor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instructors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courseInstructor->load('instructor', 'course');

        return view('admin.courseInstructors.edit', compact('courseInstructor', 'courses', 'instructors'));
    }

    public function update(UpdateCourseInstructorRequest $request, CourseInstructor $courseInstructor)
    {
        $courseInstructor->update($request->all());

        return redirect()->route('admin.course-instructors.index');
    }

    public function show(CourseInstructor $courseInstructor)
    {
        abort_if(Gate::denies('course_instructor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseInstructor->load('instructor', 'course');

        return view('admin.courseInstructors.show', compact('courseInstructor'));
    }

    public function destroy(CourseInstructor $courseInstructor)
    {
        abort_if(Gate::denies('course_instructor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseInstructor->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseInstructorRequest $request)
    {
        $courseInstructors = CourseInstructor::find(request('ids'));

        foreach ($courseInstructors as $courseInstructor) {
            $courseInstructor->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
