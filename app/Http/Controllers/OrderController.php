<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CartFormRequest;

use App\Basket\Basket;
use App\Http\Requests;

class OrderController extends Controller
{
	protected $basket;

	public function __construct(Basket $basket)
	{
		$this->basket = $basket;
	}

	/**
	 * Return the Order page.
	 * 
	 */
    public function index()
    {
    	$this->basket->refresh();

    	if (! $this->basket->subTotal()) {
    		return redirect(route('cart.index')); // Add a message.
    	}

    	return view('pages.order.index');
    }

    public function create(CartFormRequest $request)
    {
    	$this->basket->refresh();

    	if (! $this->basket->subTotal())
    	{
    		return redirect(route('cart.index')); // Add a message
    	}

    	
    }
}
