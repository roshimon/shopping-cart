<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function hasLowStock()
    {
    	return ($this->outOfStock() ? false : ($this->stock <= 5));
    }

    public function outOfStock()
    {
    	return $this->stock === 0;
    }

    public function inStock()
    {
    	return $this->stock >= 1;
    }

    public function hasStock($quantity)
    {
    	return $this->stock >= $quantity;
    }
}
