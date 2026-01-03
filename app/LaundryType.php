<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaundryType extends Model
{
    protected $table = 'laundry_types';

    protected $guarded = ['id'];

    /**
     * Relasi ke orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'laundry_type_id');
    }
}
