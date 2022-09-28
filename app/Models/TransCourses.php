<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class TransCourses extends Model
{
    use HasFactory, SoftDeletes;
    use SoftCascadeTrait;

    protected $softCascade = ['presents', 'transScores'];

    protected $fillable = [
        'class_id',
        'course_id',
        'student_id',
        'mid_score',
        'quiz_score',
        'assesment_score',
        'final_score',
        'total_score'
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

    public function present()
    {
        return $this->hasOne(TransPresents::class, 'trans_course_id')->orderBy('on', 'desc');
    }

    public function presents()
    {
        return $this->hasMany(TransPresents::class, 'trans_course_id')->orderBy('on', 'asc');
    }

    public function transScores()
    {
        return $this->hasMany(TransScore::class, 'trans_course_id');
    }
}
