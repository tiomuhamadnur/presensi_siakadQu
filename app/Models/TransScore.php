<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransScore extends Model
{
    use HasFactory;
    public function transCourse()
    {
        return $this->belongsTo(TransCourses::class, 'trans_course_id');
    }
}
