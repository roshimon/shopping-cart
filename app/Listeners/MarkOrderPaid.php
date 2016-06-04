<?php

namespace App\Listeners;

use App\Events\OrderWasCreated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MarkOrderPaid
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
     * Set `paid` to true on the Order model.
     *
     * @param  OrderWasCreated  $event
     * @return void
     */
    public function handle(OrderWasCreated $event)
    {
        $event->order->update([
            'paid' => true,
        ]);
    }
}
