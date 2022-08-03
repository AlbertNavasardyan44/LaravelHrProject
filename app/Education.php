<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Education extends Model
{
    protected $table = 'education';

    public function education(){

        return $this->hasMany('App\Faculty','uni_id', 'id');
    }
}
