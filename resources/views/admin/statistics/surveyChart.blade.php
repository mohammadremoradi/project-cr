@extends('admin.layouts.master')

@section('title')
    <title>statistics</title>

    <style>
        #survey_chart {
            width: 100%;
            height: 500px;
        }

    </style>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1>client tags</h1> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('survey.index') }}">Survey</a></li>
                        <li class="breadcrumb-item active">Survey Chart</li>
                    </ol>
                </div>
            </div>
    </section>

    @foreach ($survey as $key => $sur)
        @php
            $number = $loop->iteration;
        @endphp
        <input type="text" hidden  id="name{{ $number }}" value="{{ $sur[0]->user->name }}">
        <input type="text" hidden  id="avg{{ $number }}" value="{{ $sur->avg('value') }}">
    @endforeach

    <input type="text" hidden id="count" value="{{ $number }}">


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div id="survey_chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@section('script')
    <script src="{{ asset('admin/amcharts5/index.js') }}"></script>
    <script src="{{ asset('admin/amcharts5/xy.js') }}"></script>
    <script src="{{ asset('admin/amcharts5/themes/Animated.js') }}"></script>
    <script src="{{ asset('admin/charts/mycharts.js') }}"></script>
@endsection
