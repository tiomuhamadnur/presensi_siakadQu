<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransPresents extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'trans_course_id',
        'status',
        'description',
        'on',
    ];

    public function transCourse()
    {
        return $this->belongsTo(TransCourses::class, 'trans_course_id');
    }
}
