<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransSchedule extends Model
{
    use HasFactory;

    public function teacher()
    {
        $controller = new Controller();
        return $this->belongsTo(User::class, 'teacher_id')->where('role', $controller::ROLE_TEACHER);
    }

    public function class()
    {
        return $this->belongsTo(TblClasses::class, 'class_id');
    }

    public function course()
    {
        return $this->belongsTo(TblCourses::class, 'course_id');
    }
}
