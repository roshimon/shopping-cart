<html lang="en">

	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<title>Shopping Cart</title>

		<!-- Semantic UI -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.css">

		<!-- Custom CSS -->
		<link rel="stylesheet" href="/css/app.css">
	</head>

	<body id="app-layout">

		<nav class="ui stackable attached compact top menu" id="navigation">
            <div class="ui container">
                <div class="item">
                    <img src="http://semantic-ui.com/images/logo.png">
                </div>
                {{--<a class="item">Nieuws</a>--}}

                <div class="right menu">
                    <a href="#" class="item"><i class="cart icon"></i>Cart (0)</a>
                </div>
            </div>
            
        </nav>

		@yield('content')

		<!-- jQuery -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-rc1/jquery.min.js"></script>
		<!-- Semantic UI -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.js"></script>
	</body>

</html>