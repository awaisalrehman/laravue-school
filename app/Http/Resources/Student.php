<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Subject as SubjectResource;

class Student extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'father_name' => $this->father_name,
            'roll_no' => $this->roll_no,
            'gender' => $this->gender,
            'contact' => $this->contact,
            'address' => $this->address,
            'subjects' => SubjectResource::collection($this->whenLoaded('subjects')),
        ];
    }
}
