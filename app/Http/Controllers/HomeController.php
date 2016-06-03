<?php

namespace App\Http\Controllers;

use App\Product;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
	/**
	 * Return the Homepage view.
	 * 
	 */
    public function index()
    {
    	$products = Product::all();

		return view('pages.home', compact('products'));
    }
}
