@extends('admin.layouts.master')

@section('title')
    <title>create sourse</title>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create sourse</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sourse.index') }}">sourse</a></li>
                        <li class="breadcrumb-item active">Create sourse</li>
                    </ol>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">


                        <form action="{{ route('sourse.store') }}" method="POST">
                            @csrf
                            <div class="row p-2">
                                <div class="form-floating mb-3 c col-md-4">
                                    <input name="name" value="{{ old('name') }}" type="text" required
                                        class="form-control" id="floatingInput" placeholder="name">
                                    <label for="floatingInput">Name</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>

                                    @error('name')
                                        <span class="" role="">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-5 col-md-4">
                                    <select dir="rtl" class="form-select" name="type" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option value="Instagram" @selected(old('type') =='Instagram')>Instagram</option>
                                        <option value="Telegram" @selected(old('type') == 'Telegram')>Telegram</option>
                                        <option value="Reportage" @selected(old('type') == 'Website')>Website</option>
                                    </select>
                                    <label for="floatingSelect">Type</label>
                                </div>

                                @error('type')
                                    <span class="" role="">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="form-floating mb-3 c col-md-4">
                                    <input name="url" value="{{ old('url') }}" type="text" class="form-control"
                                        id="floatingInput" placeholder="url">
                                    <label for="floatingInput">Url</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>

                                    @error('url')
                                        <span class="" role="">
                                            <strong class="text-danger">{{ $message }}</strong>
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
