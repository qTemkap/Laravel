@extends('layouts.app')

@section('content')

	<friends :friends="{{$friends}}"></friends>

@endsection