<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TblClasses extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'teacher_guider_id',
    ];

    public function students()
    {
        $controller = new Controller();
        return $this->hasMany(User::class, 'class_id')->where('role', $controller::ROLE_STUDENT);
    }

    public function teacherGuider()
    {
        $controller = new Controller();
        return $this->belongsTo(User::class, 'teacher_guider_id')->where('role', $controller::ROLE_TEACHER);
    }

    public function getClassGuider($guiderId)
    {
        return $this->where('teacher_guider_id', $guiderId)->select(['id']);
    }
}
