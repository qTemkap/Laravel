@extends('layouts.app')

@section('content')
	<div class="container">
		@foreach($users as $user)
			@if($user->id != Auth::user()->id)
				<div class="col-lg-12">
					<a href="/dialog?userID={{$user->id}}">{{$user->name}}</a>
				</div>
			@endif
		@endforeach
	</div>
@endsection