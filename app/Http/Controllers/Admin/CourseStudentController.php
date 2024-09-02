<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCourseStudentRequest;
use App\Http\Requests\StoreCourseStudentRequest;
use App\Http\Requests\UpdateCourseStudentRequest;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseStudentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('course_student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseStudents = CourseStudent::with(['course', 'student'])->get();

        $courses = Course::get();

        $users = User::get();

        return view('admin.courseStudents.index', compact('courseStudents', 'courses', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.courseStudents.create', compact('courses', 'students'));
    }

    public function store(StoreCourseStudentRequest $request)
    {
        $courseStudent = CourseStudent::create($request->all());

        return redirect()->route('admin.course-students.index');
    }

    public function edit(CourseStudent $courseStudent)
    {
        abort_if(Gate::denies('course_student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courseStudent->load('course', 'student');

        return view('admin.courseStudents.edit', compact('courseStudent', 'courses', 'students'));
    }

    public function update(UpdateCourseStudentRequest $request, CourseStudent $courseStudent)
    {
        $courseStudent->update($request->all());

        return redirect()->route('admin.course-students.index');
    }

    public function show(CourseStudent $courseStudent)
    {
        abort_if(Gate::denies('course_student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseStudent->load('course', 'student');

        return view('admin.courseStudents.show', compact('courseStudent'));
    }

    public function destroy(CourseStudent $courseStudent)
    {
        abort_if(Gate::denies('course_student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseStudent->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseStudentRequest $request)
    {
        $courseStudents = CourseStudent::find(request('ids'));

        foreach ($courseStudents as $courseStudent) {
            $courseStudent->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
