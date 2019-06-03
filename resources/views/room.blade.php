@extends('layouts.app')

@section('content')
	<div class="container">
		<private :published="{{$room}}" :two_user="{{$id_twoUser}}" :messages_list="{{$messages}}" :user="{{Auth::user()->id}}"></private>
	</div>
@endsection