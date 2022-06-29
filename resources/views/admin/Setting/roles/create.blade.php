@extends('admin.layouts.master')


@section('content')
    <section class="container">


        <div class="row mt-5">

            <div class="col-lg-12 margin-tb ">

                <div  class="">

                    <h4>Create New Role</h4>

                </div>

                <div class="float-right ">

                    <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>

                </div>

            </div>

        </div>


        @if (count($errors) > 0)

            <div class="alert alert-danger">

                <strong>Whoops!</strong> There were some problems with your input.<br><br>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}

        <div class="row">

            <div class="col-xs-12 col-sm-12  col-md-12">

                <div class="form-group">

                    <strong>Name:</strong>

                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => ' input-group-sm form-group']) !!}

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Permission:</strong>

                    <br />

                    @foreach ($permission as $value)

                        <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}

                            {{ $value->name }}</label>

                        <br />

                    @endforeach
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </div>

        {!! Form::close() !!}

    </section>
@endsection
