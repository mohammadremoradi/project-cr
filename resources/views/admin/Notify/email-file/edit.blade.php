@extends('admin.layouts.master')

@section('title')
    <title>edit email files</title>
    <link rel="stylesheet" href="{{ asset('admin/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Email files</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('email.index') }}">Emails</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('mail-file.index' , $file->email->id) }}">Email File</a></li>
                        <li class="breadcrumb-item active">edit Email File</li>
                    </ol>
                </div>
            </div>
    </section>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">


                        <form action="{{ route('mail-file.update' , $file->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
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
                                        <label for="saveAs">Save As</label>
                                        <select name="saveAs" id="" class="form-control form-control-sm" id="status">
                                            <option value="public" @checked(old('public')) >public</option>
                                            <option value="private" @checked(old('private')) >private</option>
                                        </select>
                                    </div>
                                    @error('status')
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

@endsection
