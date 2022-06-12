<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransCourses extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'class_id',
        'course_id',
        'student_id',
        'mid_score',
        'quiz_score',
        'assesment_score',
        'final_score',
    ];

    public function course()
    {
        return $this->belongsTo(TblCourses::class, 'course_id');
    }

    public function student()
    {
        $controller = new Controller();
        return $this->belongsTo(User::class, 'student_id')->where('role', $controller::ROLE_STUDENT);
    }

    public function class()
    {
        return $this->belongsTo(TblClasses::class, 'class_id');
    }
}
