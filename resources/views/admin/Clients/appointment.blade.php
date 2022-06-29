@extends('admin.layouts.master')

@section('title')
    <title>Appointment</title>
    <link rel="stylesheet" href="{{ asset('admin/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Appointment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Appointment</li>
                    </ol>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('appointment.update', $client->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row p-2">
                                <section class="col-md-6 my-5">

                                    <h5>name : {{ $client->fullname }}</h5>

                                </section>
                                <section class="col-md-6 my-5">

                                    <h5>phone : {{ $client->phone }}</h5>

                                </section>
                                <section class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="published_at" id="published_at"
                                            class="form-control form-control-sm d-none ">
                                        <input type="text" id="published_at_view" class="form-control form-control-sm"
                                            value="{{ old('published_at') }}">
                                    </div>
                                    @error('published_at')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </section>
                                <div>
                                    <button class=" btn btn-sm btn-success p-3 m-3" type="submit">save</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@section('script')
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


    @include('admin.layouts.sweet_alert_error')
@endsection
