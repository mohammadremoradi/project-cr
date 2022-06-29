@extends('admin.layouts.master')

@section('title')
    <title>Upload File</title>
    <link rel="stylesheet" href="{{ asset('admin/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Upload File for {{ $consumer->client->fullname }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('consumer.index') }}">All Applicant </a></li>
                        <li class="breadcrumb-item"><a href="{{ route('consumer.files', $consumer->id) }}">Applicant
                                File</a></li>
                        <li class="breadcrumb-item active">Create Applicant File</li>
                    </ol>
                </div>
            </div>
    </section>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <form action="{{ route('consumer.upload.file', $consumer->id) }}" enctype="multipart/form-data"
                            method="POST">
                            @csrf
                            <div class="row p-2">
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

                                <section class="col-6">
                                    <div class="form-group">
                                        <label for="saveAs">Type</label>
                                        <select name="type" id="" class="form-control form-control-sm" id="status">

                                            @foreach ($types as $type)
                                                <option value="{{ $type }}" @checked(old('type'))>
                                                    {{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('type')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </section>

                                <div>
                                    <button class=" btn btn-sm btn-success py-3 col-1 m-3" type="submit">Upload</button>
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
