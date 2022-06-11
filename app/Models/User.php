<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'class_id',
        'name',
        'email',
        'password',
        'nip',
        'phone',
        'gender',
        'role',
        'nisn',
        'father_name',
        'parent_phone',
        'address',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function class()
    {
        return $this->belongsTo(TblClasses::class, 'class_id');
    }

    public function classGuiding()
    {
        return $this->hasOne(TblClasses::class, 'teacher_guider_id');
    }
    public function course()
    {
        return $this->hasOne(TblCourses::class, 'teacher_guider_id');
    }
}
