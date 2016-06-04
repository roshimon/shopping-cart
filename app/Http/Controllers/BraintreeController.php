<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Braintree_ClientToken;

use App\Http\Requests;

class BraintreeController extends Controller
{
    public function token()
    {
    	return response()->json([
    		'token' => Braintree_ClientToken::generate(),
		]);
    }
}
