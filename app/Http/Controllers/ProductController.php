<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests;

use Illuminate\Http\Request;

class ProductController extends Controller
{
	/**
	 * Get the product by slug.
	 * 
	 * @param  String  $slug
	 */
    public function get($slug)
    {
    	$product = Product::where('slug', $slug)->first();

    	if(! $product) {

            notify()->flash('404', 'danger', [
                'text' => 'The product was not found.',
            ]);

    		return redirect('/');
    	}

    	return view('pages.product', compact('product'));
    }
}
