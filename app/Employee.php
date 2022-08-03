<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    protected $table = 'employees';

    public function experience(){

        return $this->hasMany('App\Experience', 'employee_id', 'id');
    }


    public function experienceEchEmp(){

//        return $this->experience()->select('employee_id',DB::raw('DATEDIFF(`end`, `start`) AS subdates'))/*->groupBy('employee_id')*/;
        return $this->experience()->select('employee_id',DB::raw('ROUND(SUM(DATEDIFF(`end`, `start`))/30) AS subdates'))->groupBy('employee_id');
    }


    public function setEntryDateAttribute($input)
    {
        $this->attributes['application_date'] =
            Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
    }

    public function cvs(){

        return $this->hasMany('App\Cvs', 'employee_id','id');
    }

    public function employeeEdu(){

      return $this->hasMany('App\employeeEducation', 'employee_id', 'id');

    }
    public function SocSites(){

        return $this->hasMany('App\SocSites', 'employee_id', 'id');
    }

    public function otherEdu(){

        return $this->hasMany('App\OtherEducation', 'employee_id', 'id');
    }
}
