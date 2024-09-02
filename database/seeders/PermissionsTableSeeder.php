<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'course_create',
            ],
            [
                'id'    => 18,
                'title' => 'course_edit',
            ],
            [
                'id'    => 19,
                'title' => 'course_show',
            ],
            [
                'id'    => 20,
                'title' => 'course_delete',
            ],
            [
                'id'    => 21,
                'title' => 'course_access',
            ],
            [
                'id'    => 22,
                'title' => 'level_create',
            ],
            [
                'id'    => 23,
                'title' => 'level_edit',
            ],
            [
                'id'    => 24,
                'title' => 'level_show',
            ],
            [
                'id'    => 25,
                'title' => 'level_delete',
            ],
            [
                'id'    => 26,
                'title' => 'level_access',
            ],
            [
                'id'    => 27,
                'title' => 'lesson_create',
            ],
            [
                'id'    => 28,
                'title' => 'lesson_edit',
            ],
            [
                'id'    => 29,
                'title' => 'lesson_show',
            ],
            [
                'id'    => 30,
                'title' => 'lesson_delete',
            ],
            [
                'id'    => 31,
                'title' => 'lesson_access',
            ],
            [
                'id'    => 32,
                'title' => 'assignment_create',
            ],
            [
                'id'    => 33,
                'title' => 'assignment_edit',
            ],
            [
                'id'    => 34,
                'title' => 'assignment_show',
            ],
            [
                'id'    => 35,
                'title' => 'assignment_delete',
            ],
            [
                'id'    => 36,
                'title' => 'assignment_access',
            ],
            [
                'id'    => 37,
                'title' => 'assignment_submission_create',
            ],
            [
                'id'    => 38,
                'title' => 'assignment_submission_edit',
            ],
            [
                'id'    => 39,
                'title' => 'assignment_submission_show',
            ],
            [
                'id'    => 40,
                'title' => 'assignment_submission_delete',
            ],
            [
                'id'    => 41,
                'title' => 'assignment_submission_access',
            ],
            [
                'id'    => 42,
                'title' => 'course_instructor_create',
            ],
            [
                'id'    => 43,
                'title' => 'course_instructor_edit',
            ],
            [
                'id'    => 44,
                'title' => 'course_instructor_show',
            ],
            [
                'id'    => 45,
                'title' => 'course_instructor_delete',
            ],
            [
                'id'    => 46,
                'title' => 'course_instructor_access',
            ],
            [
                'id'    => 47,
                'title' => 'notice_create',
            ],
            [
                'id'    => 48,
                'title' => 'notice_edit',
            ],
            [
                'id'    => 49,
                'title' => 'notice_show',
            ],
            [
                'id'    => 50,
                'title' => 'notice_delete',
            ],
            [
                'id'    => 51,
                'title' => 'notice_access',
            ],
            [
                'id'    => 52,
                'title' => 'course_student_create',
            ],
            [
                'id'    => 53,
                'title' => 'course_student_edit',
            ],
            [
                'id'    => 54,
                'title' => 'course_student_show',
            ],
            [
                'id'    => 55,
                'title' => 'course_student_delete',
            ],
            [
                'id'    => 56,
                'title' => 'course_student_access',
            ],
            [
                'id'    => 57,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 58,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 59,
                'title' => 'chat_create',
            ],
            [
                'id'    => 60,
                'title' => 'chat_edit',
            ],
            [
                'id'    => 61,
                'title' => 'chat_show',
            ],
            [
                'id'    => 62,
                'title' => 'chat_delete',
            ],
            [
                'id'    => 63,
                'title' => 'chat_access',
            ],
            [
                'id'    => 64,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
