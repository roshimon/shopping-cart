<table class="ui very basic table">

@foreach($basket->all() as $item)
	<tr>
		<td>{{ $item->title }}</td>
		<td>{{ $item->quantity }}</td>
	</tr>
@endforeach

</table>