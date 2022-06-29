@extends('admin.layouts.master')

@section('title')
    <title>create sms</title>
    <link rel="stylesheet" href="{{ asset('admin/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Notification SMS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sms.index') }}">Sms</a></li>
                        <li class="breadcrumb-item active">Sms Show</li>
                    </ol>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card text-center" dir="rtl">

                        <p class="">{{ $sms->title }}</p>
                        <p>{{ $sms->body }}</p>
                        <p> {{ jalaliDate($sms->published_at) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@section('script')
    <script src="{{ asset('admin/js/count.js') }}"></script>

    <script src="{{ asset('admin/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#published_at_view').persianDatepicker({
                persianDigit: false,
                format: 'YYYY/MM/DD',
                altField: '#published_at',
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            })
        });
    </script>
@endsection
