@extends('admin.layouts.master')

@section('title')
    <title>sourse</title>
@endsection



@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>sourse</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Sourses</li>
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
                            <h3><a href="{{ route('sourse.create') }}" class="btn btn-outline-success" href="">Create</a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive ">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>name</th>
                                        <th>type</th>
                                        <th>url</th>
                                        <th>Setting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sourses as $sourse)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sourse->name }}</td>
                                            <td>{{ $sourse->type }}</td>
                                            <td>
                                                <a target="_blank" href="{{ $sourse->url }}">
                                                    {{ $sourse->url }}
                                                </a>
                                            </td>

                                            <td style="text-align:center;" class="d-flex">

                                                <a href="{{ route('sourse.edit', $sourse->id) }}"
                                                    class="btn btn-sm btn-outline-warning px-3 my-0 mx-1"><i
                                                        class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('sourse.show', $sourse->id) }}"
                                                    class="btn btn-sm btn-outline-primary px-3 my-0 mx-1"><i
                                                        class="fas fa-chart-bar icon"></i>
                                                </a>
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
