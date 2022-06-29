@extends('admin.layouts.master')

@section('title')
    <title>create status Register clients</title>
    <link rel="stylesheet" href="{{ asset('admin/jalalidatepicker/persian-datepicker.min.css') }}">

@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create status Register clients</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('status.index') }}">status Register clients</a></li>
                        <li class="breadcrumb-item active">status Register clients</li>
                    </ol>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">


                        <form action="{{ route('status.store') }}" method="POST">
                            @csrf
                            <div class="row p-2">
                                <div class="form-floating mb-3 c col-md-6">
                                    <input name="status" value="{{ old('status') }}" type="text" required
                                        class="form-control" id="floatingInput" placeholder="status">
                                    <label for="floatingInput">Status</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>
                                    @error('status')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
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




@endsection
