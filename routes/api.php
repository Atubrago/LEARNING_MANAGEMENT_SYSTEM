<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Course
    Route::apiResource('courses', 'CourseApiController');

    // Level
    Route::apiResource('levels', 'LevelApiController');

    // Lesson
    Route::post('lessons/media', 'LessonApiController@storeMedia')->name('lessons.storeMedia');
    Route::apiResource('lessons', 'LessonApiController');

    // Assignment Submission
    Route::post('assignment-submissions/media', 'AssignmentSubmissionApiController@storeMedia')->name('assignment-submissions.storeMedia');
    Route::apiResource('assignment-submissions', 'AssignmentSubmissionApiController');

    // Course Instructor
    Route::apiResource('course-instructors', 'CourseInstructorApiController');

    // Notice
    Route::post('notices/media', 'NoticeApiController@storeMedia')->name('notices.storeMedia');
    Route::apiResource('notices', 'NoticeApiController');

    // Course Student
    Route::apiResource('course-students', 'CourseStudentApiController');
});
