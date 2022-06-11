<?php

namespace App\Models;

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
}
