@extends('admin.layouts.master')

@section('title')
    <title>clients</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@endsection



@section('content')
    <section class="content-header">
        <div class="container-fluid d-">
            <div class="row mb-2">
                <div class="col-md-6">
                    @if (Request::url() === route('client.my'))
                        <a class="btn btn-primary" href="{{ route('client.outdate.my') }}"> OutDate </a>
                    @endif

                    @if (Request::url() === route('client.index'))
                        <a class="btn btn-primary" href="{{ route('client.outdate.all') }}"> OutDate </a>
                    @endif
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Clients</li>
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
                            <h3 class="card-title">Clients</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive ">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Detail</th>
                                        <th>Phone</th>
                                        <th>Consultant</th>
                                        <th>More information</th>
                                        @if (Request::url() === route('client.deletes.view'))
                                            <th>reason</th>
                                        @else
                                            <th>Status</th>
                                        @endif
                                        <th>Setting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $client->fullname }}</td>
                                            <td>
                                                <ul>
                                                    <li class="py-2"> <span class="text-danger">Bank Statement
                                                            : </span>
                                                        {{ $client->money }}</li>
                                                    <li class="py-2"> <span class="text-danger">Age : </span>
                                                        {{ $client->age }}</li>
                                                    <li class="py-2"><span class="text-danger">degree :
                                                        </span>{{ $client->degree }}</li>
                                                    <li class="py-2"> <span class="text-danger">marterial :
                                                        </span>{{ $client->material }}</li>

                                                    <li class="py-2"><span class="text-danger">children :
                                                        </span>
                                                        {{ $client->number_children }} </li>
                                                </ul>
                                            </td>
                                            <td><a class="text-dark"
                                                    href="https://wa.me/+98{{ $client->phone }}">{{ $client->phone }}</a>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li class="py-2"> <span class="text-danger"> Current
                                                            Cansultant
                                                            : </span> {{ $client->cansultant_name }} </li>
                                                    @if ($client->user_id)
                                                        <li class="py-2"> <span class="text-danger">First
                                                                Cansultant :
                                                            </span> {{ $client->user->name }}</li>
                                                    @endif
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li class="py-2"><span class="text-danger"> course :
                                                        </span>

                                                        @if ($client->course != null)
                                                            {{ $client->course->name }}
                                                        @endif


                                                    </li>

                                                    <li class="py-2"> <span class="text-danger"> minutes :
                                                        </span>
                                                        {{ $client->hours }}</li>
                                                    <li class="py-2"> <span class="text-danger"> Last Call :
                                                        </span>
                                                        {{ jalaliDate($client->next_call) }}
                                                    </li>
                                                </ul>
                                            </td>
                                            @if (Request::url() === route('client.deletes.view'))
                                                <td>
                                                    {{ $client->response }}</td>
                                            @else
                                                <td>
                                                    <li class="py-2"> <span class="text-danger">
                                                            {{ $client->intrest }}
                                                    </li>
                                                    @if ($client->tag)
                                                        <li class="py-2"> <span class="text-danger">
                                                                {{ $client->tag->name }}
                                                        </li>
                                                    @endif
                                                    <li class="py-2"> <span class="text-danger">
                                                            {{ $client->status }}
                                                    </li>
                                                    {{ $client->response }}
                                                </td>
                                            @endif
                                            <td style="text-align:center;" class="">

                                                @if (Request::url() === route('client.deletes.view'))
                                                    <a href="{{ route('client.restore', $client->id) }}"
                                                        class="btn btn-sm btn-outline-success px-3 my-0 mx-1">
                                                        <i class="fa fa-trash-restore-alt"></i>
                                                    </a>

                                                    <form class="d-inline"
                                                        action="{{ route('All-clients.destroy', $client->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('Delete')
                                                         <button type="submit"
                                                            class="btn btn-sm my-2 px-3 btn-outline-danger delete">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </form>

                                                    <a href="{{ route('client.show', $client->id) }}"
                                                        class="btn btn-sm btn-outline-primary px-3 my-2 mx-1">
                                                        <i class="far fa-check-square"></i>
                                                    </a>
                                                    <a href="{{ route('client.edit', $client->id) }}"
                                                        class="btn btn-sm btn-outline-warning px-3 my-0"><i
                                                            class="fas fa-edit"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('client.show', $client->id) }}"
                                                        class="btn btn-sm btn-outline-success px-3 my-3 mx-1">
                                                        <i class="far fa-check-square"></i>
                                                    </a>
                                                    <a href="{{ route('client.edit', $client->id) }}"
                                                        class="btn btn-sm btn-outline-warning px-3 my-3 mx-1"><i
                                                            class="fas fa-edit"></i>
                                                    </a>


                                                    <div class="dropdown ">
                                                        <a href="#"
                                                            class="btn btn-sm btn-outline-danger px-3 my-3 mx-1 dorpdown-toggle"
                                                            role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                            <form class="dropdown-item "
                                                                action="{{ route('client.response', $client->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input name="response" type="text" class="d-none"
                                                                    value="جواب نداد">
                                                                <button type="submit"
                                                                    class="dropdown-item text-center delete">
                                                                    جواب نداد </button>

                                                            </form>


                                                            <form class="dropdown-item"
                                                                action="{{ route('client.response', $client->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input name="response" type="text" class="d-none"
                                                                    value="مزاحمت">
                                                                <button type="submit"
                                                                    class="dropdown-item text-center delete">
                                                                    مزاحمت </button>

                                                            </form>



                                                            <form class="dropdown-item"
                                                                action="{{ route('client.response', $client->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input name="response" type="text" class="d-none"
                                                                    value="کشور دیگه ای مد نظرش بود">
                                                                <button type="submit"
                                                                    class="dropdown-item text-center delete">
                                                                    کشور دیگه ای مد نظرش بود </button>
                                                            </form>

                                                        </div>
                                                    </div>



                                                    <span class="dropdown ">
                                                        <a href="#"
                                                            class="btn btn-sm btn-outline-info px-3 my-3 mx-1  dorpdown-toggle"
                                                            role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                            <a class="btn btn-sm dropdown-item text-center" target="_blank"
                                                                href="https://api.whatsapp.com/send?phone=+98{{ $client->phone }}&text={{ $client->fullname }} عزیز درخواست مشاوره شما با شرکت بیاند یونیورسال ثبت شد .%0a وقت مشاوره شما در ساعت {{ jalaliDate($client->next_call, 'H:i') }} روز  {{ jalaliDate($client->next_call, '%A, %d %B %Y') }} میباشد.%0a مشاور ما با شما در تاریخ و ساعت مشخص شده تماس خواهند گرفت.">send
                                                                the time</a>

                                                            @if ($client->slug)
                                                                <a target="_blank"
                                                                    href="https://api.whatsapp.com/send?phone=+98{{ $client->phone }}&text={{ $client->fullname }}   عزیز روی لینک زیر کلیک کنید و به نحوه مشاوره امتیاز دهید   %0a{{ route('survey.create', [$client->slug, Auth::user()->slug]) }}"
                                                                    class="btn-sm dropdown-item text-center"> Survay </a>
                                                            @endif
                                                        </div>
                                                    </span>
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
