@extends('front.layouts.master')

@section('title')
    <title>Welcome {{ Auth::user()->name }}</title>
@endsection


@section('content')
    hello
@endsection
