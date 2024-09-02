<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'courses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'requirement',
        'level_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function courseLessons()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }

    public function courseCourseInstructors()
    {
        return $this->hasMany(CourseInstructor::class, 'course_id', 'id');
    }

    public function courseNotices()
    {
        return $this->hasMany(Notice::class, 'course_id', 'id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
}
