<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CartFormRequest;

use App\Address;
use App\Customer;

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

    /**
     * Create the order.
     * 
     * @param  CartFormRequest $request
     */
    public function create(CartFormRequest $request)
    {
    	$this->basket->refresh();

    	if (! $this->basket->subTotal())
    	{
    		return redirect(route('cart.index')); // Add a message
    	}

        $hash = bin2hex(random_bytes(32));

        $customer = Customer::firstOrCreate([
            'email' => $request->input('email'),
            'name' => ucwords($request->input('name')),
        ]);

        $address = Address::firstOrCreate([
            'address1' => ucfirst(strtolower($request->input('address1'))),
            'address2' => ucfirst(strtolower($request->input('address2'))),
            'city' => ucfirst(strtolower($request->input('city'))),
            'postal_code' => strtoupper($request->input('postal_code')),
        ]);

        $order = $customer->orders()->create([
            'hash' => $hash,
            'paid' => false,
            'total' => $this->basket->subTotal() + 5,
        ]);

        $address->orders()->save($order);

        $items = $this->basket->all();

        $order->products()->saveMany(
            $items,
            $this->getQuantities($items)
        );

        // Braintree
    }

    /**
     * Get the quantity from each item inside the basket.
     * 
     * @param  Array $items
     * @return Array
     */
    public function getQuantities($items)
    {
        $quantities = [];

        foreach ($items as $item) {
            $quantities[] = ['quantity' => $item->quantity];
        }

        return $quantities;
    }
}
