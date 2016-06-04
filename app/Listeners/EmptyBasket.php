<?php

namespace App\Listeners;

use App\Events\OrderWasCreated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmptyBasket
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
     * Clear the basket.
     *
     * @param  OrderWasCreated  $event
     * @return void
     */
    public function handle(OrderWasCreated $event)
    {
        $event->basket->clear();
    }


}
