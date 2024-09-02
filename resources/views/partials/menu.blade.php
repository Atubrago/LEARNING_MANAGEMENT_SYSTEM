<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <select class="searchable-field form-control">

                </select>
            </li>
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')
                            <li class="{{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <a href="{{ route("admin.permissions.index") }}">
                                    <i class="fa-fw fas fa-unlock-alt">

                                    </i>
                                    <span>{{ trans('cruds.permission.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="{{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <a href="{{ route("admin.roles.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.role.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <a href="{{ route("admin.users.index") }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>{{ trans('cruds.user.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('audit_log_access')
                            <li class="{{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                <a href="{{ route("admin.audit-logs.index") }}">
                                    <i class="fa-fw fas fa-file-alt">

                                    </i>
                                    <span>{{ trans('cruds.auditLog.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('level_access')
                <li class="{{ request()->is("admin/levels") || request()->is("admin/levels/*") ? "active" : "" }}">
                    <a href="{{ route("admin.levels.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.level.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('course_access')
                <li class="{{ request()->is("admin/courses") || request()->is("admin/courses/*") ? "active" : "" }}">
                    <a href="{{ route("admin.courses.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.course.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('course_instructor_access')
                <li class="{{ request()->is("admin/course-instructors") || request()->is("admin/course-instructors/*") ? "active" : "" }}">
                    <a href="{{ route("admin.course-instructors.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.courseInstructor.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('course_student_access')
                <li class="{{ request()->is("admin/course-students") || request()->is("admin/course-students/*") ? "active" : "" }}">
                    <a href="{{ route("admin.course-students.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.courseStudent.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('lesson_access')
                <li class="{{ request()->is("admin/lessons") || request()->is("admin/lessons/*") ? "active" : "" }}">
                    <a href="{{ route("admin.lessons.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.lesson.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('assignment_access')
                <li class="{{ request()->is("admin/assignments") || request()->is("admin/assignments/*") ? "active" : "" }}">
                    <a href="{{ route("admin.assignments.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.assignment.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('assignment_submission_access')
                <li class="{{ request()->is("admin/assignment-submissions") || request()->is("admin/assignment-submissions/*") ? "active" : "" }}">
                    <a href="{{ route("admin.assignment-submissions.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.assignmentSubmission.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('notice_access')
                <li class="{{ request()->is("admin/notices") || request()->is("admin/notices/*") ? "active" : "" }}">
                    <a href="{{ route("admin.notices.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.notice.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('chat_access')
                <li class="{{ request()->is("/chatify") || request()->is("chatify/*") ? "active" : "" }}">
                    <a href="{{ url("/chatify") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.chat.title') }}</span>

                    </a>
                </li>
            @endcan
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="{{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                        <a href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
    </section>
</aside>