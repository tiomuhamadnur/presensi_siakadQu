<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TblCourses extends Model
{
    use HasFactory, SoftDeletes;
    use SoftCascadeTrait;

    protected $softCascade = ['transCourses'];
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
        return $this->belongsTo(TblClasses::class, 'class_id');
    }

    public function teacher()
    {
        $controller = new Controller();
        return $this->belongsTo(User::class, 'teacher_id')->where('role', $controller::ROLE_TEACHER);
    }

    public function teacherGuider()
    {
        $controller = new Controller();
        return $this->belongsTo(User::class, 'teacher_guider_id')->where('role', $controller::ROLE_TEACHER);
    }

    public function transCourses()
    {
        return $this->hasMany(TransCourses::class, 'course_id');
    }
}
