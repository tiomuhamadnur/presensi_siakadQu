<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $present = null;
        if ($this->present) {
            $present = [
                'id' => $this->present->id,
                'status' => $this->present->status, //[0=>absen, 1=>hadir, 2=>sakit, 3=>izin]
                'status_redaction' => $this->presentStatusDesc((int)$this->present->status),
                'description' => $this->present->description,
                'on' => $this->present->on,
            ];
        }
        return [
            'id' => $this->id,
            'student' => [
                'id' => $this->student->id,
                'name' => $this->student->name,
                'nisn' => $this->student->nisn,
            ],
            'present' => $present
        ];
    }

    public function presentStatusDesc($statusNumber)
    {
        $presentStatus = ['absen', 'hadir', 'sakit', 'izin'];
        return isset($presentStatus[$statusNumber]) ? $presentStatus[$statusNumber] : 'undefined';
    }
}
