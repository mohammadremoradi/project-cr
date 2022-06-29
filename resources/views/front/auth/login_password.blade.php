<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('front/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/login/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/login/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/login/css/main.css') }}">
    <meta name="robots" content="nofollow, noindex, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />

</head>

<body>

    <div class="limiter">
        <nav>
            <img src="{{ asset('admin/images/logo-header-menu.png') }}" width="100px" alt="">
        </nav>
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset('front/login/images/img-01.png') }}" alt="IMG">
                </div>

                <form action="{{ route('set.password', $user->id) }}" class="login100-form validate-form"
                    method="POST">
                    @csrf

                    @method('PUT')
                    <span class="login100-form-title">
                        Member Login
                    </span>
                    <input type="text" name="phone" hidden value="{{ $user->phone }}" id="">
                    <input type="text" name="email" hidden value="" id="">


                    <div id="password" class="wrap-input100 validate-input " data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    @error('password')
                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                            <strong>
                                {{ $message }}
                            </strong>
                        </span>
                    @enderror


                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" id="bt">
                            Login
                        </button>
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

    <script src="{{ asset('front/login/js/main.js') }}"></script>

</body>

</html>
