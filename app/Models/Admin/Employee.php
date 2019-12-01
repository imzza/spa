<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'eebiotbl';
    protected $primaryKey = 'weeid';

    // protected $fillable = [];

    public function getRouteKeyName()
    {
        return 'weeid';
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
