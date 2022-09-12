<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TblCourses extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id',
        'name',
        'teacher_id',
        'class_id',
        'schedule',
        'time'
    ];

    public function class()
    {
        return $this->belongsTo(TblClasses::class, 'class_id')->withTrashed();
    }

    public function teacher()
    {
        $controller = new Controller();
        return $this->belongsTo(User::class, 'teacher_id')->where('role', $controller::ROLE_TEACHER)->withTrashed();
    }

    public function teacherGuider()
    {
        $controller = new Controller();
        return $this->belongsTo(User::class, 'teacher_guider_id')->where('role', $controller::ROLE_TEACHER)->withTrashed();
    }

    public function transCourses()
    {
        return $this->hasMany(TransCourses::class, 'course_id');
    }
}
