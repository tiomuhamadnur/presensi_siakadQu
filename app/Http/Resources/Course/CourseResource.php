<?php

namespace App\Http\Resources\Course;

use App\Http\Controllers\Utils;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    use Utils;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->course->id,
            'name' => $this->course->name,
            'day' => $this->getDayRedaction((int)$this->day),
            'time' => $this->time,
            'class' => $this->class,
            'student_count' => $this->course->transCourses->count()
        ];
    }
}
