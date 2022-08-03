<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employeeEducation extends Model
{
    protected $table = 'employee_education';

    public function faculty(){
        return $this->hasOne('App\Faculty', 'id','faculty_id');
    }
}
