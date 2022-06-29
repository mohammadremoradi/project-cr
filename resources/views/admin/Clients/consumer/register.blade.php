@extends('admin.layouts.master')

@section('title')
    <title>Register Client</title>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Applicant </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('consumer.index') }}">Applicant</a></li>
                        <li class="breadcrumb-item active">Reggister Applicant</li>
                    </ol>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('consumer.register', $client->id) }}" method="POST">
                            @csrf
                            <div class="row p-2">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-floating mb-3 c col-md-4">
                                    <input dir="rtl" name="name" value="{{ old('name', $client->fullname) }}" type="text"
                                        required class="form-control" id="floatingInput" placeholder="name">
                                    <label for="floatingInput">Name</label>
                                    @error('name')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3 c col-md-4">
                                    <input dir="rtl" name="phone" required value="{{ old('phone', $client->phone) }}"
                                        type="text" required class="form-control" id="floatingInput" placeholder="phone">
                                    <label for="floatingInput">phone</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>
                                    @error('phone')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-floating mb-3 col-md-4">
                                    <select dir="rtl" class="form-select" name="user_id" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @selected($user->id == Auth::user()->id)>
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">Consultant Name </label>
                                </div>
                                <div class="form-floating mb-3 col-md-4">
                                    <select dir="rtl" class="form-select" name="status_id" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}" @selected(old('status'))>
                                                {{ $status->status }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">Status </label>
                                </div>


                                <div class="form-floating mb-3 c col-md-4">
                                    <input dir="rtl" name="email" value="{{ old('email', $client->email) }}" type="text"
                                         class="form-control" id="floatingInput" placeholder="email">
                                    <label for="floatingInput">Email</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>
                                    @error('email')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>


                            </div>
                            <button class="btn btn-success col-1 m-3" type="submit">save</button>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
@endsection
