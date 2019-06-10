@extends('layouts.app')

@section('content')

    <debits :debit="{{$debit}}" :credit="{{$credit}}"></debits>
    
@endsection