@extends('layouts.app')

@section('content')

<div class="ui container stackable grid">

	<div class="five wide column">
		<img class="ui medium rounded image" src="{{ $product->image }}" alt="{{ $product->title }} image">
	</div>

	<div class="eleven wide column">
	@if($product->hasLowStock())
		<div class="ui orange label">Low stock
			<div class="detail">{{ $product->stock }}</div>
		</div>
	@endif

	@if($product->outOfStock())
		<div class="ui red label">Out of stock</div>
	@endif

		<h3>{{ $product->title }}</h3>
		<p>{{ $product->description }}</p>

		@if($product->inStock())
		<a href="{{ route('cart.add', ['slug' => $product->slug, 'quantity' => 1]) }}" class="ui labeled icon button">
			<i class="add to cart icon"></i>Add to cart
		</a>
		@endif
	</div>

</div>

@endsection