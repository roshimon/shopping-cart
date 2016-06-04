<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Basket\Basket;
use App\Product;

use App\Exception\QuantityExceededException;

class CartController extends Controller
{
    protected $basket;
    protected $product;

    public function __construct(Basket $basket, Product $product)
    {
        $this->basket = $basket;
        $this->product = $product;
    }

	/**
	 * Show all items in the Cart.
	 * 
	 */
    public function index()
    {
        //return response()->json($this->basket->all());
        $this->basket->refresh();
        
    	return view('pages.cart.index', ['basket' => $this->basket]);
    }

    /**
     * Add items to the Cart.
     * 
     */
    public function add($slug, $quantity)
    {
    	$product = $this->product->where('slug', $slug)->first();

        if (! $product)
        {
            return redirect('/');
        }

        try {
            $this->basket->add($product, $quantity);

        } catch(QuantityExceededException $e) {
            return $e;
        }

        return redirect(route('cart.index', ['basket' => $this->basket]));
    }
}
