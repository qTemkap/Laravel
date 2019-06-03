@extends('layouts.app')

@section('content')

	<search :user="{{Auth::user()->id}}" :users="{{$users}}"></search>

@endsection