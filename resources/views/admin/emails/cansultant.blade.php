@extends('admin.emails.layouts.master')

@section('head-tag')

@endsection


@section('content')

<h2>{{ $details['title'] }}</h2>
{{-- <p>{{ $details['body'] }}</p> --}}
<p>Client name = {{ $details['body']['name'] }}</p>
<p>Client phone = {{ $details['body']['phone'] }}</p>
<p>Time = {{ jalaliDate($details['body']['time']) }}</p>

@endsection
