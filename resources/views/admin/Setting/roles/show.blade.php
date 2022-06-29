@extends('admin.layouts.master')


@section('content')

<section class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb mt-5">
            <div class="pull-left">
                <h4> Show Role</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Name: </strong>

                {{ $role->name }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong class="">Permissions: </strong>

                <br>
                @if (!empty($rolePermissions))

                <br>
                    @foreach ($rolePermissions as $v)

                        <label class="">{{ $v->name }}   </label>
                        <br>

                    @endforeach

                @endif

            </div>

        </div>

    </div>
</section>

@endsection
