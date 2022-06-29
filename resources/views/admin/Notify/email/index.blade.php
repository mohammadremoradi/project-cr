@extends('admin.layouts.master')

@section('title')
    <title>Email</title>
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
                        <div class="card-header text-right">
                            <h3><a href="{{ route('email.create') }}" class="btn btn-outline-success" href="">create</a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive ">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject</th>
                                        <th>body</th>
                                        <th>Tag</th>
                                        <th>published time</th>
                                        <th>Setting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emails as $email)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $email->subject }}</td>
                                            <td>
                                                {!! $email->body !!}
                                            </td>

                                            <td>
                                               {{ $email->tag->name }}
                                            </td>
                                            <td>
                                                {{ jalaliDate($email->published_at) }}
                                            </td>

                                            <td style="text-align:center;" class="d-flex">
                                                <a href="{{ route('email.show', $email->id) }}"
                                                    class="btn btn-sm btn-outline-success px-3 my-0 mx-1">
                                                    <i class="far fa-check-square"></i>
                                                </a>
                                                <a href="{{ route('email.edit', $email->id) }}"
                                                    class="btn btn-sm btn-outline-warning px-3 my-0 mx-1"><i
                                                        class="fas fa-edit"></i></a>

                                                        <a href="{{ route('mail-file.index', $email->id) }}"
                                                    class="btn btn-sm btn-outline-info px-3 my-0 mx-1"><i
                                                        class="fas fa-file"></i></a>

                                                <form class="d-inline"
                                                    action="{{ route('email.destroy', $email->id) }}" method="post">
                                                    @csrf
                                                    @method('Delete')
                                                    <button type="submit" class="btn btn-outline-danger delete">

                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
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

    @include('admin.layouts.toast')
@endsection



@section('script')

@include('admin.layouts.delete_confirm' , ['className' => "delete"])

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

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

@endsection
