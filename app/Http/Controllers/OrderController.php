<?php

namespace App\Http\Controllers;

use App\Address;
use App\Basket\Basket;
use App\Customer;

use Storage;

use App\Events\OrderWasCreated;

use App\Http\Requests;
use App\Http\Requests\CartFormRequest;

use App\Order;

use Braintree_Transaction;

use PDF;

class OrderController extends Controller
{
    /**
     * Instance of Basket.
     *
     * @var Basket
     */
	protected $basket;

    /**
     * Create a new OrderController instance.
     *
     * @param Basket $basket
     */
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

            notify()->flash('Whoops..', 'error', [
                'text' => 'You can\'t order if your cart is empty.',
            ]);

    		return redirect(route('cart.index'));
    	}

    	return view('pages.order.index');
    }

    /**
     * Show the order.
     *
     * @param $hash
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function show($hash)
    {
        $order = Order::with('address', 'products')->where('hash', $hash)->first();

        if(! $order) {

            notify()->flash('404', 'error', [
                'text' => 'We couldn\'t find that order.',
            ]);

            return redirect(route('home'));
        }

        return view('pages.order.show', compact('order'));
    }

    /**
     * Create the order.
     * 
     * @param CartFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(CartFormRequest $request)
    {
    	$this->basket->refresh();

    	if (! $this->basket->subTotal()) {

            notify()->flash('Whoops..', 'error', [
                'text' => 'You can\'t order if your cart is empty.',
            ]);

    		return redirect(route('cart.index'));
    	}

        if (! $request->input('payment_method_nonce')) {

            notify()->flash('Something went wrong..', 'error', [
                'text' => 'Please try again.',
            ]);

            return redirect(route('order.index'));
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
            'total' => ($this->basket->subTotal() + 5),
        ]);

        $address->orders()->save($order);

        $items = $this->basket->all();

        $order->products()->saveMany(
            $items,
            $this->getQuantities($items)
        );

        $result = Braintree_Transaction::sale([
            'amount' => ($this->basket->subTotal() + 5),
            'paymentMethodNonce' => $request->input('payment_method_nonce'),
            'options' => [
                'submitForSettlement' => true,
            ]
        ]);

        event(new OrderWasCreated($order, $this->basket));

        if (! $result->success) {

            // TODO: Find a way to attach listeners manually to the OrderWasCreated event.

            $order->payment()->created([
                'failed' => true,
            ]);

            notify()->flash('Something went wrong.', 'error', [
                'text' => 'Please try again.',
            ]);

            return redirect(route('order.index'));
        } else {

            $order->payment()->create([
                'failed' => false,
                'transaction_id' => $result->transaction->id,
            ]);

            $this->basket->clear();

            notify()->flash('Sweet!', 'success', [
                'text' => 'Your order has been placed.',
            ]);

            return redirect(route('order.show', $order->hash));
        }
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

    /**
     * Generate and download the invoice as a PDF file.
     *
     * @param  String $hash
     */
    public function download($hash)
    {
        $order = Order::where('hash', $hash)->first();

        PDF::useScript(resource_path('assets/js/generate-pdf.js'));

        return PDF::createFromView(view('pages.order.invoice', compact('order')), "order-{$order->id}.pdf");
    }
}
