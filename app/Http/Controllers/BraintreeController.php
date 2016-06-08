<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Braintree_ClientToken;

use Illuminate\Http\Request;

class BraintreeController extends Controller
{
	/**
	 * Generate a new BrainTree ClientToken.
	 */
    public function token()
    {
    	return response()->json([
    		'token' => Braintree_ClientToken::generate(),
		]);
    }
}
