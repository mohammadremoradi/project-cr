@extends('admin.layouts.master')

@section('title')
    <title>Advertise</title>
@endsection


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <span class="px-5"> Budget = {{ $budget }}   </span>
                    <span class="px-5"> cost = {{ $cost }}   </span>
                    <span class="px-5"> total = {{ $total }}  </span>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Advertise</li>
                    </ol>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header text-right ">
                            <h3><a href="{{ route('advertise.create') }}" class="btn btn-outline-success"
                                    href="">Create</a>
                            </h3>
                        </div>

                        <div class="card-body table-responsive ">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>name</th>
                                        <th>price</th>
                                        <th>statistics</th>
                                        <th>time</th>
                                        <th>Setting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($advetises as $advetise)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $advetise->sourse->name }}</td>
                                            <td>{{ $advetise->price }}</td>
                                            <td>{{ $advetise->statistics }}</td>
                                            <td>{{ jalaliDate($advetise->published_at) }}</td>

                                            <td style="text-align:center;" class="d-flex">
                                                <a href="{{ route('advertise.edit', $advetise->id) }}"
                                                    class="btn btn-sm btn-outline-warning px-3 my-0 mx-1"><i
                                                        class="fas fa-edit"></i>
                                                </a>

                                                @if ($advetise->receipt)
                                                    <a class="btn btn-sm btn-outline-info px-3 mx-1"
                                                        href="{{ route('receipt.download', $advetise->id) }}"><i
                                                            class="fa fa-download "></i>
                                                    </a>
                                                @endif
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
