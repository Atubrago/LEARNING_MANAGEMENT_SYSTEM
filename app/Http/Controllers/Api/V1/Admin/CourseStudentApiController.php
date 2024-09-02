<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseStudentRequest;
use App\Http\Requests\UpdateCourseStudentRequest;
use App\Http\Resources\Admin\CourseStudentResource;
use App\Models\CourseStudent;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseStudentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('course_student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseStudentResource(CourseStudent::with(['course', 'student'])->get());
    }

    public function store(StoreCourseStudentRequest $request)
    {
        $courseStudent = CourseStudent::create($request->all());

        return (new CourseStudentResource($courseStudent))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CourseStudent $courseStudent)
    {
        abort_if(Gate::denies('course_student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseStudentResource($courseStudent->load(['course', 'student']));
    }

    public function update(UpdateCourseStudentRequest $request, CourseStudent $courseStudent)
    {
        $courseStudent->update($request->all());

        return (new CourseStudentResource($courseStudent))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CourseStudent $courseStudent)
    {
        abort_if(Gate::denies('course_student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseStudent->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
