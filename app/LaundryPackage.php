<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaundryPackage extends Model
{
    protected $guarded = ['id'];    

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
