@extends('admin.layouts.master')

@section('title')
    <title>Applicant's file</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@endsection



@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Applicant's file</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('consumer.index') }}">Applicant</a></li>
                        <li class="breadcrumb-item active">Applicant's form</li>
                    </ol>
                </div>
            </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('consumer.upload.file.view', $consumer->id) }}"
                                class="card-title btn btn-primary btn-sm p-3 m-4">Upload File</a>


                            <a href="{{ route('consumer.download.file.zip', $consumer->id) }}"
                                class="card-title btn btn-primary btn-sm p-3 m-4">Download Files</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive ">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Setting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $file->file_name }}</td>
                                            <td>{{ $file->type }}</td>
                                            <td>
                                                @if ($file->activation == 0)
                                                    <span class="right p-2 badge badge-warning">
                                                        Waiting for admin approval
                                                    </span>
                                                @endif
                                                @if ($file->activation == 1)
                                                    <span class="right p-2 badge badge-danger">
                                                        The document is not approved
                                                    </span>
                                                @endif

                                                @if ($file->activation == 2)
                                                    <span class="right p-2 badge badge-success">
                                                        The document was approved
                                                    </span>
                                                @endif

                                            </td>

                                            <td style="text-align:center;" class="">
                                                <a href="{{ route('consumer.download.file', $file->id) }}"
                                                    class="btn btn-sm btn-outline-success px-3 my-3 mx-1">
                                                    <i class="fas fa-file-download"></i>
                                                </a>

                                                {{-- <a href="{{ route('consumer.delete.file', $file->id) }}"
                                                    class="btn btn-sm btn-outline-danger delete px-3 my-3 mx-1">
                                                    <i class="fas fa-trash-o"></i>
                                                </a> --}}


                                                <form class="d-inline"
                                                    action="{{ route('consumer.delete.file', $file->id) }}" method="post">
                                                    @csrf
                                                    @method('Delete')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger delete px-3 my-3 mx-1 delete">
                                                        <i class="fas fa-trash-o"></i>
                                                    </button>
                                                </form>

                                                <div class="dropdown ">
                                                    <a href="#"
                                                        class="btn btn-sm btn-outline-primary px-3 my-3 mx-1 dorpdown-toggle"
                                                        role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-support"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                        <form class="dropdown-item "
                                                            action="{{ route('consumer.file.status', $file->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input name="activation" type="text" class="d-none"
                                                                value="1">
                                                            <button type="submit" class="dropdown-item text-center">
                                                                The document is not approved
                                                            </button>

                                                        </form>


                                                        <form class="dropdown-item"
                                                            action="{{ route('consumer.file.status', $file->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <input name="activation" type="text" class="d-none"
                                                                value="2">
                                                            <button type="submit" class="dropdown-item text-center">
                                                                The document was approved
                                                            </button>

                                                        </form>

                                                    </div>
                                                </div>


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

    @include('admin.layouts.sweet_alert_error')
@endsection
