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
                    <h1>Notification</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Sms</li>
                    </ol>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">


                        <form action="{{ route('sms.update' , $sms->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row p-2">
                                <div class="form-floating mb-3 c col-md-6">
                                    <input name="title" value="{{ old('title' , $sms->title) }}" type="text" onkeyup="counterTitle(this)" required
                                        class="form-control" id="floatingInput" placeholder="title">
                                    <label for="floatingInput">Title</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <section class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="">تاریخ انتشار</label>
                                        <input type="text" name="published_at" value="{{ $sms->published_at }}" id="published_at"
                                            class="form-control form-control-sm d-none ">
                                        <input type="text" id="published_at_view" value="{{ $sms->published_at }}" class="form-control form-control-sm">
                                    </div>
                                    @error('published_at')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </section>

                                <div class="form-floating">
                                    <textarea name="body" onkeyup="counterBody(this)" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 100px">{{ old('body' , $sms->body) }}</textarea>
                                    <label for="floatingTextarea2">Body</label>

                                    <span id="counterBody" class="right badge badge-danger p-2"></span>
                                    <br>
                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div>

                                    <button class=" btn btn-sm btn-success py-3 col-1 m-3" type="submit">save</button>
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
