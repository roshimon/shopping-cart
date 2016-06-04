<?php

namespace App\Listeners;

use App\Events\OrderWasCreated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateStock
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Decrement the product stock with the quantity from the ordered product.
     *
     * @param  OrderWasCreated  $event
     * @return void
     */
    public function handle(OrderWasCreated $event)
    {
        foreach ($event->basket->all() as $product) {
            $product->decrement('stock', $product->quantity);
        }
    }
}
