<?php

namespace App\Http\Controllers;

use App\Basket\Basket;
use App\Exceptions\QuantityExceededException;

use App\Http\Requests;

use App\Product;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Instance of Basket.
     *
     * @var Basket
     */
    protected $basket;

    /**
     * Instance of Product.
     * @var Product
     */
    protected $product;

    /**
     * Create a new CartController instance.
     *
     * @param Basket  $basket
     * @param Product $product
     */
    public function __construct(Basket $basket, Product $product)
    {
        $this->basket = $basket;
        $this->product = $product;
    }

    /**
     * Show all items in the Basket.
     *
     */
    public function index()
    {
        $this->basket->refresh();

    	return view('pages.cart.index');
    }

    /**
     * Add items to the Basket.
     *
     * @param $slug
     * @param $quantity
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add($slug, $quantity)
    {
    	$product = $this->product->where('slug', $slug)->first();

        if (! $product) {
            return redirect('/');
        }

        try {
            $this->basket->add($product, $quantity);
        } catch(QuantityExceededException $e) {
            return $e->message;
        }

        return redirect(route('cart.index'));
    }

    /**
     * Update the Basket items.
     *
     * @param         $slug
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \App\Exceptions\QuantityExceededException
     */
    public function update($slug, Request $request)
    {
        $product = $this->product->where('slug', $slug)->first();

        if (! $product) {

            notify()->flash('404', 'success', [
                'text' => 'The product was not found.',
            ]);

            return redirect('/');
        }

        try {
            $this->basket->update($product, $request->input('quantity'));
        } catch(QuantityExceededException $e) {
            return $e->message;
        }

        return redirect(route('cart.index'));
    }
}
