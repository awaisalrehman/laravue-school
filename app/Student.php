<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function getGenderAttribute($attribute)
    {
        return [
            1 => 'Male',
            2 => 'Female',
            3 => 'Other',
        ][$attribute];
    }

    /**
     * subjects that belong to the student.
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
