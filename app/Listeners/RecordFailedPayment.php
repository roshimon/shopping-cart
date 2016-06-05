<?php

namespace App\Listeners;

use App\Events\OrderWasCreated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecordFailedPayment
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
     * Set `failed` to true on the Payment model.
     *
     * @param  OrderWasCreated  $event
     * @return void
     */
    public function handle(OrderWasCreated $event)
    {
        notify()->flash('Something went wrong.', 'error', [
            'text' => 'Please try again.',
        ]);
        
        $event->order->payment()->created([
            'failed' => true,
        ]);
    }
}
