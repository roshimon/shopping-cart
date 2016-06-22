<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $quantity = null;

    /**
     * Check if a product has a low stock.
     *
     * @return boolean
     */
    public function hasLowStock()
    {
    	return ($this->outOfStock() ? false : ($this->stock <= 5));
    }

    /**
     * Check if a product is out of stock.
     *
     * @return boolean
     */
    public function outOfStock()
    {
    	return $this->stock === 0;
    }

    /**
     * Check if a product is in stock.
     *
     * @return boolean
     */
    public function inStock()
    {
    	return $this->stock >= 1;
    }

    /**
     * Check if a product has an x amount of stock.
     *
     * @param  Integer  $quantity The amount of stock to check.
     * @return boolean
     */
    public function hasStock($quantity)
    {
    	return $this->stock >= $quantity;
    }

    /**
     * Get the Order(s) containing the Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany('App\Order')->withPivot('quantity');
    }
}
