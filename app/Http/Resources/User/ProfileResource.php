<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "nip" => $this->nip,
            "nik" => $this->nik,
            "born_at" => $this->born_at,
            "birthday" => $this->birthday,
            "phone" => $this->phone,
            "gender" => $this->gender,
            "role" => $this->role,
            "address" => $this->address,
            "photo" => $this->photo ? url($this->photo) : null,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "class_guidings" => $this->classGuidings,
        ];
    }
}
