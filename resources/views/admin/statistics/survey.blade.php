@extends('admin.layouts.master')

@section('title')
    <title>Survey</title>
@endsection


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Survey</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Survey</li>
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
                            <h3>
                                <a href="{{ route('survey.chart') }}" class="btn btn-outline-success" href="">Bar
                                    chart</a>
                            </h3>
                        </div>

                        <div class="card-body table-responsive ">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Name </th>
                                        <th> Result </th>
                                        <th> Cansultant </th>
                                        <th> Comment </th>
                                        <th> setting </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($surveys as $survey)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $survey->client->fullname }}</td>
                                            <td>{{ $survey->value }}</td>
                                            <td>{{ $survey->user->name }}</td>
                                            <td>{{ $survey->comment }}</td>
                                            <td>
                                                <a class="btn btn-info" href="{{ route('survey.show', $survey->id) }}">
                                                    <i class="fas fa-pen    "></i>
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
