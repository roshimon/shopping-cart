@extends('layouts.app')

@section('content')
<div class="ui container stackable grid">

@foreach($products as $index => $product)
	<div class="four wide column">
		<div class="ui fluid card">
			<div class="image">
	    		<img src="{{ $product->image }}" alt="{{ $product->title }} image">
	  		</div>
	  		<div class="content">
	    		<a class="header">{{ $product->title }}</a>
	    		<div class="meta">
	    			{{ $product->price }}
	    		</div>
	    		<div class="description">{{ $product->description }}</div>
	  		</div>
	  		<div class="extra content">
	    		<a href="{{ route('product.view', $product->slug) }}" class="ui button fluid blue">View</a>
	  		</div>
		</div>
	</div>
@endforeach

</div>
@endsection
