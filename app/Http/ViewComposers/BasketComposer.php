<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Basket\Basket;

class BasketComposer
{
    /**
     * The Basket implementation.
     *
     * @var Basket
     */
    protected $basket;

    /**
     * Create a new Basket composer.
     *
     * @param  Basket  $basket
     */
    public function __construct(Basket $basket)
    {
        // Dependencies automatically resolved by service container...
        $this->basket = $basket;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('basket', $this->basket);
    }
}
