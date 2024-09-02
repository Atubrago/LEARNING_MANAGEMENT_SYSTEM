<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAssignmentSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::table('assignment_submissions', function (Blueprint $table) {
            $table->unsignedBigInteger('assignment_id')->nullable();
            $table->foreign('assignment_id', 'assignment_fk_10012490')->references('id')->on('assignments');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id', 'student_fk_10012491')->references('id')->on('users');
        });
    }
}
