@extends('admin.layouts.master')

@section('title')
    <title>create email</title>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row m-2">
                <div class="col-sm-6">
                    <h1>Notification Email</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('email.index') }}">Emails</a></li>
                        <li class="breadcrumb-item active">Show email</li>
                    </ol>
                </div>
            </div>
    </section>



    <section dir="" class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card text-center m-5 p-5  " dir="rtl">

                        <p class="">{{ $email->subject }}</p>
                        <p>{!! $email->body !!}</p>
                        <p> {{ jalaliDate($email->published_at) }}
                        </p>
                        <div  dir="ltr" class="card-body table-responsive ">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>name</th>
                                        <th>phone</th>
                                        <th>tag name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $client->fullname }}</td>

                                            <td>
                                                {{ $client->phone }}
                                            </td>

                                            <td>
                                               {{ $client->tag->name }}
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
