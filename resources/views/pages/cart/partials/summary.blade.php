<table class="ui very basic table">
	<tr>
		<td><strong>Sub total</strong></td>
		<td><strong>€{{ number_format($item->price, 2, ',', ' ') }}</strong></td>
	</tr>

	<tr>
		<td>Shipping</td>
		<td>€5,00</td>
	</tr>

	<tr>
		<td class="positive"><strong>Total</strong></td>
		<td class="positive"><strong>€{{ number_format($basket->subTotal() + 5, 2, ', ', ' ') }}</strong></td>
	</tr>
</table>