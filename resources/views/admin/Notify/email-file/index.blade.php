@extends('admin.layouts.master')

@section('title')
    <title>Email Files</title>
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
                        <li class="breadcrumb-item active">Email File</li>
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
                            <h3><a href="{{ route('mail-file.create', $email->id) }}" class="btn btn-outline-success"
                                    href="">Create</a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive ">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject</th>
                                        <th>File Name</th>
                                        <th>File type</th>
                                        <th>save as</th>
                                        <th>Setting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($email->files as $file)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $email->subject }}</td>
                                            <td>
                                                {!! $file->file_name !!}
                                            </td>
                                            <td>
                                                {{ $file->file_type }}
                                            </td>
                                            <td>
                                               {{ $file->saveAs }}
                                           </td>

                                            <td style="text-align:center;" class="d-flex">
                                                <a href="{{ route('mail-file.edit', $file->id) }}"
                                                    class="btn btn-sm btn-outline-success px-3 my-0 mx-1">
                                                    <i class="far fa-check-square"></i>
                                                </a>


                                                <form class="d-inline"
                                                    action="{{ route('mail-file.destroy', $file->id) }}" method="post">
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
