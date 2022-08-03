<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';
    public $timestamps = false;

    public function Roles() {

        return $this->hasOne('App\Role','id', 'role_id');
    }
}
