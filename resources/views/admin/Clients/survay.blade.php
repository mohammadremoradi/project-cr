<!DOCTYPE html>
<html lang="en">

<head>
    <title>نظر سنحی مشاوره </title>
    <meta charset="UTF-8">
    <meta name="robots" content="nofollow, noindex, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('front/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/login/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/login/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/login/css/main.css') }}">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('admin/css/survey.css') }}">


    <meta name="description" content="عزیز لطفا ما را در بهبود مشاوره یاری کنید {{ $client->fullname }}" />


    <link rel="canonical" href="{{ asset('admin/images/logo-header-menu.png') }}" />

    <meta property="og:title" content="نظرسنجی | بیاند یونیورسال" />
    <meta property="og:description"
        content="   " />
</head>

<body>

    <div class="limiter">
        <nav>
            <img src="{{ asset('admin/images/logo-header-menu.png') }}" width="100px" alt="">
        </nav>
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt col-md-6" data-tilt>
                    <img src="{{ asset('front/login/images/img-01.png') }}" alt="IMG">
                </div>

                <form class="col-md-6" method="POST"
                    action="{{ route('survey.store', [$client->id, $user->id]) }}">

                    @csrf
                    @method('post')
                    <div class="form-group text-center clear-both ">
                        <label for="exampleFormControlTextarea1" class="text-center "> {{ $client->fullname }} عزیز
                            جهت ارتقا کیفیت سطح مشاوره شرکت بیاند ممنون میشیم در نظر سنجی ما شرکت کنید </label>
                    </div>

                    <div class="form-group d-flex flex-row-reverse justify-content-center">
                        <input required value="5" class="star star-5" id="star-5" type="radio" name="star" />
                        <label class="star star-5" for="star-5"></label>
                        <input value="4" class="star star-4" id="star-4" type="radio" name="star" />
                        <label class="star star-4" for="star-4"></label>
                        <input value="3" class="star star-3" id="star-3" type="radio" name="star" />
                        <label class="star star-3" for="star-3"></label>
                        <input value="2" class="star star-2" id="star-2" type="radio" name="star" />
                        <label class="star star-2" for="star-2"></label>
                        <input value="1" class="star star-1" id="star-1" type="radio" name="star" />
                        <label class="star star-1" for="star-1"></label>
                    </div>

                    <div class="form-group text-center clear-both">
                        <textarea name="comment" class="form-control" id="exampleFormControlTextarea1"
                            rows="3">{{ old('comment') }}</textarea>
                    </div>

                    <div class="text-center ">
                        <button type="submit" class="btn btn-group-lg px-5 py-3 btn-danger">ارسال</button>
                    </div>

                </form>
            </div>
        </div>
    </div>



    <script src="{{ asset('front/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('front/login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('front/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/login/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('front/login/vendor/tilt/tilt.jquery.min.js') }}"></script>

    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>

    <script src="{{ asset('admin/sweetalert/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('front/login/js/main.js') }}"></script>
    @include('admin.layouts.sweet_alert_error')


    @if (session('swal-success'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: ' با تشکر از شما',
                    text: '{{ session('swal-success') }}',
                    icon: 'success',
                    confirmButtonText: 'باشه',
                });
            });
        </script>
    @endif


</body>

</html>
