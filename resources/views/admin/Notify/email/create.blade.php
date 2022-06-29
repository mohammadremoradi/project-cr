@extends('admin.layouts.master')

@section('title')
    <title>create Email</title>
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
                        <li class="breadcrumb-item active">Email</li>
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

                        <form action="{{ route('email.store') }}" method="POST">
                            @csrf
                            <div class="row p-2">
                                <div class="form-floating mb-3 c col-md-4">
                                    <input name="subject" value="{{ old('subject') }}" type="text"
                                        onkeyup="counterTitle(this)" required class="form-control" id="floatingInput"
                                        placeholder="title">
                                    <label for="floatingInput">Subject</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>
                                    @error('subject')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>

                                <section class="col-12 col-md-4">
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
                                <div class="form-floating mb-5 col-md-4">
                                    <select dir="rtl" class="form-select" name="tag_id" id="floatingSelect"
                                        aria-label="Floating label select example">

                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">
                                                {{ $tag->name }}</option>
                                        @endforeach

                                    </select>
                                    <label for="floatingSelect">Tags</label>
                                </div>

                                <div class="form-floating">
                                    <textarea id="body" name="body" onkeyup="counterBody(this)" class="form-control" placeholder="Leave a comment here"
                                        id="floatingTextarea2" style="height: 100px">{{ old('body') }}</textarea>

                                    <span id="counterBody" class="right badge badge-danger p-2"></span>
                                    <br>
                                    @error('body')
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
    <script src="{{ asset('admin/js/count.js') }}"></script>

    <script src="{{ asset('admin/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin/jalalidatepicker/persian-datepicker.min.js') }}"></script>

    <script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript">
        CKEDITOR.replace('body');
    </script>

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
