<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hash', 'total', 'address_id', 'paid',
    ];

    /**
     * Get the address(es) that belongs to the order.
     *
     * @return \Illuminate\Database\Eloquent\belongsTo
     */
    public function address()
    {
    	return $this->belongsTo('App\Address');
    }

    /**
     * Get the customer who made the Order.
     *
     * @return \Illuminate\Database\Eloquent\belongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    /**
     * Get the product(s) that the order contains.
     *
     * @return \Illuminate\Database\Eloquent\belongsToMany
     */
    public function products()
    {
    	return $this->belongsToMany('App\Product', 'orders_products')->withPivot('quantity');
    }

    /**
     * Get the Payment that the Order has.
     *
     * @return \Illuminate\Database\Eloquent\hasOne
     */
    public function payment()
    {
        return $this->hasOne('App\Payment');
    }
}
