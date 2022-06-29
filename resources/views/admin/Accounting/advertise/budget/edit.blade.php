@extends('admin.layouts.master')

@section('title')
    <title>EDIT budget</title>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit budget</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('budget.index') }}">budget</a></li>
                        <li class="breadcrumb-item active">Edit budget</li>
                    </ol>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">


                        <form action="{{ route('budget.update' , $budget->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row p-2">
                                <div class="form-floating mb-3 c col-md-6">
                                    <input name="price" value="{{ old('price' , $budget->price) }}" type="text" required
                                        class="form-control" id="floatingInput" placeholder="price">
                                    <label for="floatingInput">price</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>
                                    @error('price')
                                        <span class="" role="">
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


@endsection
