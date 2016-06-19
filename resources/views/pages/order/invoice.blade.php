<html lang="en">

    <head>
        <meta charset="utf-8">

        <title>Invoice #{{ $order->id }}</title>

        <!-- Semantic UI -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.css">

        <style>
            body {
                font-size: .7em;
            }

            .logo {
                width: 80px;
            }
        </style>
    </head>

    <body>

        <div class="ui container">

            <div class="ui grid">
                <div class="sixteen column row">
                    <div class="nine wide column">
                        <h3>Order #{{ $order->id }}</h3>

                        <h4>Shipped to</h4>
                        <p>
                            <strong>{{ $order->customer->name }}</strong><br>
                            {{ $order->address->address1 }}<br>
                            @if($order->address->address2)
                            {{ $order->address->address2 }}<br>
                            @endif
                            {{ $order->address->city }}<br>
                            {{ $order->address->postal_code }}<br>
                        </p>
                    </div>
                    <div class="seven wide column">
                        <img src="https://s3.amazonaws.com/s3.codecourse.com/public/apple-touch-icon-180x180.png" alt="Codecourse logo" class="ui right floated image logo">
                        <p>
                            <strong>Codecourse Ltd.</strong><br>
                            11 Course Place<br>
                            London<br>
                            CC1CC1<br>
                            Email: <a href="mailto:hello@codecourse.com">hello@codecourse.com</a><br>
                            Phone: +44 (0) 1337 320 242
                        </p>
                    </div>
                </div>
            </div>

            <div class="ui divider"></div>



            <h4>Ordered products</h4>

            <table class="ui very basic compact table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>€{{ number_format(($product->pivot->quantity * $product->price), 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td></td>
                        <td>€5,00</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th><strong>Order total</strong></th>
                        <th>{{ $order->totalQuantity() }}</th>
                        <th><strong>€{{ number_format($order->total, 2, ',', '.')}}</strong></th>
                    </tr>
                </tfoot>
            </table>

        </div>

    </body>

</html>
