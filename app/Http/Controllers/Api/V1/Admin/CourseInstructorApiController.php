<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseInstructorRequest;
use App\Http\Requests\UpdateCourseInstructorRequest;
use App\Http\Resources\Admin\CourseInstructorResource;
use App\Models\CourseInstructor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseInstructorApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('course_instructor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseInstructorResource(CourseInstructor::with(['instructor', 'course'])->get());
    }

    public function store(StoreCourseInstructorRequest $request)
    {
        $courseInstructor = CourseInstructor::create($request->all());

        return (new CourseInstructorResource($courseInstructor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CourseInstructor $courseInstructor)
    {
        abort_if(Gate::denies('course_instructor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseInstructorResource($courseInstructor->load(['instructor', 'course']));
    }

    public function update(UpdateCourseInstructorRequest $request, CourseInstructor $courseInstructor)
    {
        $courseInstructor->update($request->all());

        return (new CourseInstructorResource($courseInstructor))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CourseInstructor $courseInstructor)
    {
        abort_if(Gate::denies('course_instructor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseInstructor->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
