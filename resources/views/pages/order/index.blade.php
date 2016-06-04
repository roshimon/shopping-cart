@extends('layouts.app')

@section('content')

<div class="ui stackable container">
	
	{{-- TODO: Turn autocomplete off --}}
	<form class="ui form" action="{{ route('order.create') }}" method="POST">
		{{ csrf_field() }}

		<div class="ui grid">

			<div class="six wide column">
				<h2>Your details</h2>

				<div class="required field{{ $errors->has('email') ? ' error' : '' }}">
	    			<label>Email</label>
	    			<input type="email" name="email" placeholder="john@exmaple.com" value="{{ old('email') }}" required>
	    			@if ($errors->has('email'))
	                    <div class="ui pointing red basic label">{{ $errors->first('email') }}</div>
	                @endif
	  			</div>
	  
	  			<div class="required field{{ $errors->has('name') ? ' error' : '' }}">
	    			<label>Full Name</label>
					<input type="text" name="name" placeholder="Full name" value="{{ old('name') }}" required>
					@if ($errors->has('name'))
                        <div class="ui pointing red basic label">{{ $errors->first('name') }}</div>
                    @endif
	  			</div>

			</div>

			<div class="ten wide column">
				<h2>Shipping Address</h2>

				<div class="two fields">
					<div class="required field{{ $errors->has('address1') ? ' error' : '' }}">
		    			<label>Address line 1</label>
		    			<input type="text" name="address1" value="{{ old('address1') }}" required>
		    			@if ($errors->has('address1'))
	                        <div class="ui pointing red basic label">{{ $errors->first('address1') }}</div>
	                    @endif
		  			</div>

		  			<div class="field{{ $errors->has('address2') ? ' error' : '' }}">
		    			<label>Address line 2</label>
		    			<input type="text" name="address2" value="{{ old('address2') }}">
		    			@if ($errors->has('address2'))
	                        <div class="ui pointing red basic label">{{ $errors->first('address2') }}</div>
	                    @endif
		  			</div>
				</div>

				<div class="two fields">
					<div class="required field{{ $errors->has('city') ? ' error' : '' }}">
		    			<label>City</label>
		    			<input type="text" name="city" value="{{ old('city') }}" required>
		    			@if ($errors->has('city'))
	                        <div class="ui pointing red basic label">{{ $errors->first('city') }}</div>
	                    @endif
		  			</div>

		  			<div class="required field{{ $errors->has('postal_code') ? ' error' : '' }}">
		    			<label>Postal code</label>
		    			<input type="text" name="postal_code" value="{{ old('postal_code') }}" required>
		    			@if ($errors->has('postal_code'))
                        <div class="ui pointing red basic label">{{ $errors->first('postal_code') }}</div>
                    @endif
		  			</div>
				</div>
			</div>

		</div>

		<div class="ui grid">
			<div class="six wide column">
				<h2>Your order</h2>

				<div class="ui segments">
				
					<div class="ui segment">
						@include('pages.cart.partials.contents')
					</div>

					<div class="ui segment">
						@include('pages.cart.partials.summary')
					</div>

					<div class="ui segment">
						<button type="submit" class="ui labeled blue fluid icon button">
							<i class="cart icon"></i>Place order
						</a>
					</div>

				</div>
			</div>

			<div class="ten wide column">
				<h2>Payment</h2>
				<div id="payment"></div>
			</div>
		</div>


	</form>
</div>

@endsection

@push('scripts')
<script src="https://js.braintreegateway.com/js/braintree-2.24.1.min.js"></script>
<script type="text/javascript">
	$.ajax({
		url: '{{ route('braintree.token') }}',
		type: 'get',
		dataType: 'json',
		success: function (data) {
			braintree.setup(data.token, 'dropin', {
				container: 'payment'
			});
		}
	});
</script>
@endpush