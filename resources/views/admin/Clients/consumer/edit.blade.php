@extends('admin.layouts.master')

@section('title')
    <title>Edit Applicant </title>
    <link rel="stylesheet" href="{{ asset('admin/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <a class="btn btn-primary" href="{{ URL::previous() }}"> Back </a>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('client.my') }}"> Applicant </a></li>
                        <li class="breadcrumb-item active">Edit Applicant</li>
                    </ol>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <form action="{{ route('consumer.update', $client->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row p-2">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-floating mb-3 c col-md-3">
                                    <input dir="rtl" name="fullname" value="{{ old('fullname', $client->fullname) }}"
                                        type="text" required class="form-control" id="floatingInput"
                                        placeholder="fullname">
                                    <label for="floatingInput">fullname</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>
                                    @error('fullname')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3 c col-md-3">
                                    <input dir="rtl" value="{{ old('age', $client->age) }}" name="age" type="text"
                                        required class="form-control" id="floatingInput" placeholder="fullname">
                                    <label for="floatingInput">Age</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>

                                    @error('age')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3 c col-md-3">
                                    <input dir="rtl" name="degree" value="{{ old('degree', $client->degree) }}" required
                                        type="text" class="form-control" id="floatingInput" placeholder="degree">
                                    <label for="floatingInput">Degree</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>

                                    @error('degree')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3 c col-md-3">
                                    <input dir="rtl" name="date_degree"
                                        value="{{ old('date_degree', $client->date_degree) }}" type="text"
                                        class="form-control" id="floatingInput" placeholder="date_degree">
                                    <label for="floatingInput">Date Degree</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>

                                    @error('date_degree')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3 c col-md-4">
                                    <input dir="rtl" name="language" value="{{ old('language', $client->language) }}"
                                        type="text" class="form-control" id="floatingInput" placeholder="date_degree">
                                    <label for="floatingInput"> language</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>

                                    @error('language')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3 c col-md-4">
                                    <input dir="rtl" name="job" value="{{ old('job', $client->job) }}" type="text"
                                        class="form-control" id="floatingInput" placeholder="job">
                                    <label for="floatingInput"> Job</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>

                                    @error('job')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3 c col-md-4">
                                    <input dir="rtl" name="money" value="{{ old('money', $client->money) }}" type="text"
                                        class="form-control" id="floatingInput" placeholder="job">
                                    <label for="floatingInput"> Bank statement </label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>

                                    @error('money')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3 c col-md-4">
                                    <input dir="rtl" name="phone" value="{{ old('phone', $client->phone) }}" type="text"
                                        class="form-control" id="floatingInput" placeholder="phone">
                                    <label for="floatingInput"> Phone Number </label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>
                                    @error('phone')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3 col-md-4">
                                    <select dir="rtl" class="form-select" name="material" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option dir="rtl" value="single" class=""
                                            @selected('single' == $client->material)>
                                            Single
                                        </option>
                                        <option value="married" @selected('married' == $client->material)> Married
                                        </option>
                                    </select>
                                    <label for="floatingSelect">material</label>
                                </div>

                                <div class="form-floating mb-3 c col-md-4">
                                    <input dir="rtl" value="{{ old('number_children', $client->number_children) }}"
                                        name="number_children" type="text" class="form-control" id="floatingInput"
                                        placeholder="phone">
                                    <label for="floatingInput"> Number of Children</label>
                                    <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                    <br>

                                    @error('number_children')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror

                                </div>
                                @if ($client->material == 'married')
                                    <h5 class="mb-4 d-flex"> Spouse's information </h5>

                                    <div class="form-floating mb-3 c col-md-4">
                                        <input dir="rtl" name="age_wife" value="{{ old('age_wife', $client->age_wife) }}"
                                            type="text" class="form-control" id="floatingInput" placeholder="">
                                        <label for="floatingInput"> Age </label>
                                        <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                        <br>

                                        @error('age_wife')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="form-floating mb-3 c col-md-4">
                                        <input dir="rtl" name="wife_degree"
                                            value="{{ old('wife_degree', $client->wife_degree) }}" type="text"
                                            class="form-control" id="floatingInput" placeholder="wife_degree">
                                        <label for="floatingInput"> Degree </label>
                                        <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                        <br>

                                        @error('wife_degree')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="form-floating mb-3 c col-md-4">
                                        <input dir="rtl" name="wife_date_degree"
                                            value="{{ old('wife_date_degree', $client->wife_date_degree) }}" type="text"
                                            class="form-control" id="floatingInput" placeholder="wife_date_degree">
                                        <label for="floatingInput"> Date degree </label>
                                        <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                        <br>

                                        @error('wife_date_degree')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror

                                    </div>
                                @endif
                                @if ($client->number_children != null)
                                    <h5 class="mb-4 d-flex">Children Age</h5>

                                    @for ($i = 1; $i <= $client->number_children; $i++)
                                        <div class="form-floating mb-3 c col-md-4">
                                            <input dir="rtl" name="child{{ $i }}"
                                                value="{{ old('child' . $i, $client['child' . $i]) }}" type="text"
                                                class="form-control" id="floatingInput" placeholder="">
                                            <label for="floatingInput"> age child {{ $i }}</label>
                                            <span id="counterTitle" class="right badge badge-danger p-2"></span>
                                            <br>

                                            @error("child'.$i")
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror

                                        </div>
                                    @endfor
                                @endif
                                <br>

                                <div class="row" dir="rtl">

                                    <div class="form-floating mb-3 col-md-4">
                                        <textarea dir="rtl" class="form-control " name="discription" cols="3" rows="2" placeholder="Leave a comment here"
                                            id="floatingTextarea2"
                                            style="height: 100px">{{ old('discription', $client->discription) }}</textarea>
                                        <label for="floatingTextarea2">Comment</label>
                                        @error('discription')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </div>










                                    <div class="form-floating mb-3 col-md-4">
                                        <select dir="rtl" class="form-select" name="cansultant_name" id="floatingSelect"
                                            aria-label="Floating label select example">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}" @selected($user->id == Auth::user()->id)>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingSelect">Consultant Name </label>
                                    </div>


                                    <div class="form-floating mb-3 col-md-4">
                                        <select dir="rtl" class="form-select" name="course_id" id="floatingSelect"
                                            aria-label="Floating label select example">
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}" @selected(old('course_id') || $course->id == $client->course_id)>
                                                    {{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingSelect"> Service </label>
                                    </div>


                                </div>



                                <div class="form-floating mb-5 col-md-4">
                                    <select dir="rtl" class="form-select" name="tag_id" id="floatingSelect"
                                        aria-label="Floating label select example">

                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}" @selected(old('tag_id') || $tag->id == $client->tag_id)>
                                                {{ $tag->name }}</option>
                                        @endforeach

                                    </select>
                                    <label for="floatingSelect">Tags</label>
                                </div>


                                <div class="form-floating mb-5 col-md-4">
                                    <select dir="rtl" class="form-select" name="status_id" id="floatingSelect"
                                        aria-label="Floating label select example">

                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}" @selected(old('status_id') || $status->id == $client->consumer->status_id)>
                                                {{ $status->status }}
                                            </option>
                                        @endforeach

                                    </select>
                                    <label for="floatingSelect">Tags</label>
                                </div>

                                <div class="form-floating mb-5 col-md-4">
                                    <select dir="rtl" class="form-select" name="activation" id="floatingSelect"
                                        aria-label="Floating label select example">

                                        <option value="0" @selected(old('activation') || "0" == $client->consumer->activation)>
                                            in active
                                        </option>

                                        <option value="1" @selected(old('activation') || "1" == $client->consumer->activation)>
                                            Active
                                        </option>


                                    </select>
                                    <label for="floatingSelect">Activation</label>
                                </div>
                            </div>
                            <button class="btn btn-success p-3 m-3" type="submit">save</button>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    <script src="{{ asset('admin/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin/jalalidatepicker/persian-datepicker.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#published_at_view').persianDatepicker({
                persianDigit: false,
                format: 'YYYY/MM/DD',
                altField: '#published_at',
                minDate: new persianDate().unix(),
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            })
        });
    </script>
@endsection
