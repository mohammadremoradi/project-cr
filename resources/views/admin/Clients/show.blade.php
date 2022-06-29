@extends('admin.layouts.master')
@section('title')
    <title>client show</title>

    <style>
        .ul {
            padding-top: 1rem;
        }

        .ul li {
            padding-top: 2rem;
            list-style: none;
        }

        .ul li span {
            font-weight: 900;
        }

        .dis {
            padding-top: 2rem;
            padding-bottom: 2rem;
            font-weight: 900;
        }

    </style>
@endsection


@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="col-md-6">
                        <a class="btn btn-primary" href="{{ URL::previous() }}"> Back </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Clients</li>
                    </ol>
                </div>
            </div>
    </section>


    <section dir="ltr" class="m-5 p-5 align-content-center ">


        <ul class="nav nav-tabs justify-content-evenly" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">مشخصات فرد اصلی</button>
            </li>
            @if ($client['material'] == 'married')
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">مشخصات همسر</button>
                </li>
            @endif
            @if ($client['number_children'] != null)
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                        type="button" role="tab" aria-controls="contact" aria-selected="false"> مشخصات فرزندان</button>
                </li>
            @endif

            <li dir="rtl" class=" float-right"><a class="btn btn-success"
                    href="{{ route('client.edit', $client->id) }}">Edit</a></li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <section class="d-flex justify-content-between">
                    <div class="row justify-content-between w-100">
                        <ul class="ul col-md-4 col-sm-6">
                            <li> <span class="text-capitalize">name : </span> {{ $client->fullname }} </li>
                            <li> <span class="text-capitalize">Age :</span> {{ $client->age }} </li>
                            <li> <span class="text-capitalize">material :</span> {{ $client->material }} </li>
                            <li> <span class="text-capitalize">job :</span> {{ $client->job }} </li>
                            <li> <span class="text-capitalize">Current cansultant :</span> {{ $client->cansultant_name }}
                            </li>
                            <li> <span class="text-capitalize">status :</span> {{ $client->status }} </li>
                            @if ($client->tag)
                                <li> <span class="text-capitalize">Tag :</span> {{ $client->tag->name }} </li>
                            @endif
                        </ul>

                        <ul class="ul col-md-4 col-sm-6">
                            <li> <span class="text-capitalize">degree : </span> {{ $client->degree }} </li>
                            <li> <span class="text-capitalize">language :</span> {{ $client->language }} </li>
                            <li> <span class="text-capitalize">number of children :</span> {{ $client->number_children }}
                            </li>
                            <li> <span class="text-capitalize">hours :</span> {{ $client->hours }}
                            </li>
                            @if ($client->discription != null)
                                <li> <span class="text-capitalize">first cansultant :</span> {{ $client->user->name }}
                                </li>
                            @endif
                            <li> <span class="text-capitalize">next call :</span> {{ jalaliDate($client->next_call) }}
                            </li>
                        </ul>

                        <ul class="ul col-md-4 col-sm-6">
                            <li> <span class="text-capitalize">date degree :</span> {{ $client->date_degree }} </li>
                            <li> <span class="text-capitalize">Bank Statement :</span> {{ $client->money }} </li>
                            <li> <span class="text-capitalize">phone :</span><a
                                    href="https://wa.me/{{ $client->phone }}">{{ $client->phone }}</a> </li>
                            <li> <span class="text-capitalize">intrest :</span> {{ $client->intrest }} </li>
                            @if ($client->course_id != null)
                                <li> <span class="text-capitalize">Service :</span> {{ $client->course->name }} </li>
                            @endif
                            <li> <span class="text-capitalize">about us :</span> {{ $client->about_us }} </li>
                        </ul>
                    </div>
                </section>

                <p class="text-capitalize dis">Description : <br> <span>{{ $client->discription }} </span> </p>


            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <section class="d-flex justify-content-between">
                    <div class="row justify-content-between w-100">
                        <ul class="ul col-md-4 col-sm-6">
                            <li> <span class="text-capitalize">age wife : </span> {{ $client->age_wife }} </li>
                            <li> <span class="text-capitalize">wife degree :</span> {{ $client->wife_degree }} </li>
                            <li> <span class="text-capitalize">date degree :</span> {{ $client->wife_date_degree }} </li>
                        </ul>
                    </div>
                </section>
            </div>

            @if ($client['number_children'] != null)
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <section class="d-flex justify-content-between">
                        <div class="row justify-content-between w-100">
                            <ul class="ul col-md-4 col-sm-6">
                                @for ($i = 1; $i <= $client['number_children']; $i++)
                                    <li> <span class="text-capitalize">age child {{ $i }} :</span>
                                        {{ $client['child' . $i] }} </li>
                                @endfor
                            </ul>
                        </div>
                    </section>
                </div>
            @endif
        </div>
    </section>


@endsection
