<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * Get the Order(s) from the User.
     *
     * @return \Illuminate\Database\Eloquent\hasMany
     */
    public function orders()
    {
    	return $this->hasMany('App\Order');
    }
}
