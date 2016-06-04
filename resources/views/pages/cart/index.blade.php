@extends('layouts.app')

@section('content')

<div class="ui container">
	{{ json_encode($basket->all()) }}
</div>

@endsection