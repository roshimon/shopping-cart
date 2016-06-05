<html lang="en">

	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<title>Shopping Cart</title>

		<!-- Semantic UI -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.css">
		<!-- SweetAlert -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
		<!-- Custom CSS -->
		<link rel="stylesheet" href="/css/app.css">
	</head>

	<body id="app-layout">

		<nav class="ui stackable attached compact top menu" id="navigation">
            <div class="ui container">
                <a href="{{ route('home') }}" class="item">
                    <img src="/img/logo.png">
                </a>

                <div class="right menu">
                    <a href="{{ route('cart.index') }}" class="item"><i class="cart icon"></i>Cart ({{ $basket->itemCount() }})</a>
                </div>
            </div>
            
        </nav>

		@yield('content')

		<!-- jQuery -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-rc1/jquery.min.js"></script>
		<!-- Semantic UI -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.js"></script>
		<!-- SweetAlert -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
		@if (notify()->ready())
	    <script>
	        swal({
	            title: "{!! notify()->message() !!}",
	            text: "{!! notify()->option('text') !!}",
	            type: "{{ notify()->type() }}",
	            @if (notify()->option('timer'))
	                timer: {{ notify()->option('timer') }},
	                showConfirmButton: false
	            @endif
	        });
	    </script>
		@endif
		@stack('scripts')
	</body>

</html>