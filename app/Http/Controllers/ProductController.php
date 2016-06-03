<?php

namespace App\Http\Controllers;

use App\Product;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProductController extends Controller
{
	/**
	 * Get the product by slug
	 * 
	 * @param  String  $slug    The slug of the product
	 */
    public function get($slug)
    {
    	$product = Product::where('slug', $slug)->first();

    	if(! $product)
    	{
    		return redirect('/'); // TODO: Add a nice 404 page :-)
    	}

    	return view('pages.product', compact('product'));
    }
}
