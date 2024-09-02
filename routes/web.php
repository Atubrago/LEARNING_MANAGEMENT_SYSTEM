<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Course
    Route::delete('courses/destroy', 'CourseController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/parse-csv-import', 'CourseController@parseCsvImport')->name('courses.parseCsvImport');
    Route::post('courses/process-csv-import', 'CourseController@processCsvImport')->name('courses.processCsvImport');
    Route::resource('courses', 'CourseController');

    // Level
    Route::delete('levels/destroy', 'LevelController@massDestroy')->name('levels.massDestroy');
    Route::resource('levels', 'LevelController');

    // Lesson
    Route::delete('lessons/destroy', 'LessonController@massDestroy')->name('lessons.massDestroy');
    Route::post('lessons/media', 'LessonController@storeMedia')->name('lessons.storeMedia');
    Route::post('lessons/ckmedia', 'LessonController@storeCKEditorImages')->name('lessons.storeCKEditorImages');
    Route::resource('lessons', 'LessonController');

    // Assignment
    Route::delete('assignments/destroy', 'AssignmentController@massDestroy')->name('assignments.massDestroy');
    Route::post('assignments/media', 'AssignmentController@storeMedia')->name('assignments.storeMedia');
    Route::post('assignments/ckmedia', 'AssignmentController@storeCKEditorImages')->name('assignments.storeCKEditorImages');
    Route::resource('assignments', 'AssignmentController');

    // Assignment Submission
    Route::delete('assignment-submissions/destroy', 'AssignmentSubmissionController@massDestroy')->name('assignment-submissions.massDestroy');
    Route::post('assignment-submissions/media', 'AssignmentSubmissionController@storeMedia')->name('assignment-submissions.storeMedia');
    Route::post('assignment-submissions/ckmedia', 'AssignmentSubmissionController@storeCKEditorImages')->name('assignment-submissions.storeCKEditorImages');
    Route::resource('assignment-submissions', 'AssignmentSubmissionController');

    // Course Instructor
    Route::delete('course-instructors/destroy', 'CourseInstructorController@massDestroy')->name('course-instructors.massDestroy');
    Route::resource('course-instructors', 'CourseInstructorController');

    // Notice
    Route::delete('notices/destroy', 'NoticeController@massDestroy')->name('notices.massDestroy');
    Route::post('notices/media', 'NoticeController@storeMedia')->name('notices.storeMedia');
    Route::post('notices/ckmedia', 'NoticeController@storeCKEditorImages')->name('notices.storeCKEditorImages');
    Route::resource('notices', 'NoticeController');

    // Course Student
    Route::delete('course-students/destroy', 'CourseStudentController@massDestroy')->name('course-students.massDestroy');
    Route::resource('course-students', 'CourseStudentController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Chat
    Route::delete('chats/destroy', 'ChatController@massDestroy')->name('chats.massDestroy');
    Route::resource('chats', 'ChatController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
