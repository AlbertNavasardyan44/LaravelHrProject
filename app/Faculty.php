<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculty';

    public function  facultyEmp(){
        return $this->hasOne('App\Education','id','uni_id');
    }
}
