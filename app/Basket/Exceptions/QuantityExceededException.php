<?php

namespace App\Basket\Exceptions;

use Exception;

class QuantityExceededException extends Exception
{
	/**
	 * The message that will be shown if the exception has been thrown.
	 * 
	 * @var string
	 */
	protected $message = 'You have added the maximum stock for this item';
}