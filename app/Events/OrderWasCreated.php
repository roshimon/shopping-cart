<?php

namespace App\Events;

use App\Order;
use App\Basket\Basket;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderWasCreated extends Event
{
    use SerializesModels;

    public $order;
    
    public $basket;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, Basket $basket)
    {
        $this->order = $order;
        $this->basket = $basket;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
