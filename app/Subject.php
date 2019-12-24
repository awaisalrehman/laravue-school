<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];

    /**
     * students that belong to the subject.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
