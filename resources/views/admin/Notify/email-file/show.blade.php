@extends('admin.layouts.master')

@section('title')
    <title>create sms</title>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row m-2">
                <div class="col-sm-6">
                    <h1>Notification Email</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('email.index') }}">Emails</a></li>
                        <li class="breadcrumb-item active">Show email</li>
                    </ol>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card text-center m-5 p-5  " dir="rtl">

                        <p class="">{{ $email->subject }}</p>
                        <p>{!! $email->body !!}</p>
                        <p> {{ jalaliDate($email->published_at) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@section('script')

@endsection
