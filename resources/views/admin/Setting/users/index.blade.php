@extends('admin.layouts.master')

@section('title')
    <title>Users</title>
@endsection



@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-right">

                            <h3><a href="{{ route('users.create') }}" class="btn btn-outline-success" href="">Create</a>
                            </h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive ">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>name</th>
                                        <th>Email or Phone</th>
                                        <th>Role</th>
                                        <th>Setting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                @if ($user->phone)
                                                    {{ $user->phone }}
                                                @else
                                                    {{ $user->email }}
                                                @endif
                                            </td>


                                            <td>
                                                @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $v)
                                                        <label class="badge badge-success">{{ $v }}</label>
                                                    @endforeach
                                                @endif
                                            </td>

                                            <td>
                                                @can('setting-user-role')
                                                    <a class="btn btn-primary"
                                                        href="{{ route('users.edit', $user->id) }}">Edit</a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                                    {!! Form::close() !!}
                                                @endcan

                                                @can('setting-user-promission')
                                                    @if ($user->is_admin === '1')
                                                        <form action="{{ route('is_admin', $user->id) }}" method="POST"
                                                            class="d-inline-flex">
                                                            @csrf
                                                            @method('PUT')
                                                            <button name="is_admin" value="0"
                                                                class="btn btn-danger  d-inline mt-2">Click to be not
                                                                admin</button>
                                                        </form>
                                                    @endif

                                                    @if ($user->is_admin === '0')
                                                        <form action="{{ route('is_admin', $user->id) }}" method="POST"
                                                            class="d-inline-flex">
                                                            @csrf
                                                            @method('PUT')
                                                            <button name="is_admin" value="1"
                                                                class=" d-inline btn btn-warning mt-2">Click to be
                                                                admin</button>
                                                        </form>
                                                    @endif

                                                    <form action="{{ route('user.reset.password', $user->id) }}"
                                                        method="POST" class="d-inline-flex">
                                                        @csrf
                                                        @method('PUT')
                                                        <button name="is_admin" value="1"
                                                            class=" d-inline btn btn-info mt-2">reset
                                                            password</button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@section('script')
    @include('admin.layouts.delete_confirm', ['className' => 'delete'])
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "order": [
                    [0, "desc"]
                ],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
