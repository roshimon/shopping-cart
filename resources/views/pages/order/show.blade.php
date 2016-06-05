@extends('layouts.app')

@section('content')

<div class="ui stackable container">
	
	<h1 class="ui header">Order #{{ $order->id }}</h1>
	<div class="ui divider"></div>

	<div class="ui grid">
		<div class="eight wide column">
			<h2 class="ui header">Shipped to</h2>
			<p>
				{{ $order->address->address1 }}<br>
				@if($order->address->address2)
				{{ $order->address->address2 }}<br>
				@endif
				{{ $order->address->city }}<br>
				{{ $order->address->postal_code }}<br>
			</p>
		</div>

		<div class="eight wide column">
			<h2 class="ui header">Items</h2>
			
			<div class="ui list">
			@foreach($order->products as $product)
				<span class="item">
					<a href="{{ route('product.view', $product->slug) }}" class="ui label">
					  	{{ $product->title }}
						<div class="detail">{{ $product->pivot->quantity }}x</div>
					</a>
				</span>
			@endforeach
			</div>
		</div>
	</div>
	
	<div class="ui divider"></div>
	<p>Shipping: €5,00 <br>
	<strong>Order total: €{{ number_format($order->total, 2, ',', '.') }}</strong>
	</p>

</div>

@endsection