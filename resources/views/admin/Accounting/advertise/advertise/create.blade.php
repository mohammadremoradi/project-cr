@extends('admin.layouts.master')

@section('title')
    <title>create Ads</title>
    <link rel="stylesheet" href="{{ asset('admin/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Ads</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('advertise.index') }}">Ads</a></li>
                        <li class="breadcrumb-item active">Create Ads</li>
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
                        <form action="{{ route('advertise.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row p-2">

                                <div class="form-floating mb-3 col-md-4">
                                    <select dir="rtl" class="form-select" name="sourse_id" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        @foreach ($sourses as $sourse)
                                            <option value="{{ $sourse->id }}" @selected($sourse->id == $sourse->sourse_id)>
                                                {{ $sourse->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect"> Name </label>
                                </div>


                                <div class="form-floating mb-3 c col-md-4">
                                    <input name="price" value="{{ old('price') }}" type="text" required
                                        class="form-control" id="floatingInput" placeholder="price">
                                    <label for="floatingInput">Price</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>
                                    @error('price')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>

                                <section class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for=""> PUBLISHE TIME</label>
                                        <input type="text" name="published_at" id="published_at"
                                            class="form-control form-control-sm d-none ">
                                        <input type="text" id="published_at_view" class="form-control form-control-sm">
                                    </div>
                                    @error('published_at')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </section>

                                <div class="form-floating mb-3 col-md-4">
                                    <select dir="rtl" class="form-select" name="user_id" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @selected($user->id == Auth::user()->id)>
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">user name </label>
                                </div>

                                <section class="col-6">
                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <input type="file" class="form-control form-control-sm" name="file" id="file">
                                    </div>
                                    @error('file')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </section>

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
