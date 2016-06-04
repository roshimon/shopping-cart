<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests;

use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
	 * Return the Home view.
	 * 
	 */
    public function index()
    {
    	$products = Product::all();

		return view('pages.home', compact('products'));
    }
}
