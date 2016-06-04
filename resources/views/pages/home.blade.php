@extends('layouts.app')

@section('content')
<div class="ui container centered stackable grid">

@foreach($products as $index => $product)
	<div class="five wide column">
		<div class="ui fluid card">
			<div class="image">
	    		<img src="{{ $product->image }}" alt="{{ $product->title }} image">
	  		</div>
	  		<div class="content">
	    		<a href="{{ route('product.view', $product->slug) }}" class="header">{{ $product->title }}</a>
	    		<div class="meta">
	    			{{ $product->price }}
	    		</div>
	    		<div class="description">{{ $product->description }}</div>
	  		</div>
		</div>
	</div>
@endforeach

</div>
@endsection
