@extends('admin.layouts.master')


@section('content')


    <section class="container">

        <div class="row mt-5">

            <div class="col-lg-12 margin-tb">

                <div class="pull-left">

                    <h4>Role Management</h4>

                </div>

                <div class="float-right mb-5">

                    @can('setting-role-create')
                        <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
                    @endcan

                </div>

            </div>

        </div>


        @if ($message = Session::get('success'))

            <div class="alert alert-success">

                <p>{{ $message }}</p>

            </div>

        @endif


        <section class="table-responsive">


        <table class="table">

            <tr>

                <th>No</th>

                <th>Name</th>

                <th width="280px">Action</th>

            </tr>

            @foreach ($roles as $key => $role)
                <tr>

                    <td>{{ ++$i }}</td>

                    <td>{{ $role->name }}</td>

                    <td>

                        <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">Show</a>

                        @can('setting-role-edit')

                            <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Edit</a>

                        @endcan

                        @can('setting-role-delete')

                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}

                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

                            {!! Form::close() !!}

                        @endcan

                    </td>

                </tr>

            @endforeach

        </table>

    </section>


        {!! $roles->render() !!}
    </section>

@endsection
