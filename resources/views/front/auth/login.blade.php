{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('check.password') }}" method="POST">

        @csrf

        <label for="identity">phone or email</label>
        <input type="text" name="identity">
        @error('identity')
            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                <strong>
                    {{ $message }}
                </strong>
            </span>
        @enderror

        <button type="submit">send</button>

    </form>
</body>

</html> --}}



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

                <form action="{{ route('check.password') }}" class="login100-form validate-form" method="POST">

                    @csrf
                    <span class="login100-form-title">
                        Member Login
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" id="identity" type="text" name="identity" placeholder="Email Or Phone">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>

                    </div>


                    @error('identity')
                        <span class="alert_required bg-danger float-right text-white p-1 rounded" role="alert">
                            <strong>
                                {{ $message }}
                            </strong>
                        </span>
                    @enderror
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" id="bt">
                            Send
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

    {{-- <script>
        $("#bt").click(function(event) {

            event.preventDefault();
            var ele = $('#identity');
            var ident = ele.val();

            var url = ele.attr('data-url');
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    identity: ident,
                    _token: _token
                },
                success: function(response) {

                    console.log(response);

                    if (response.status == "false") {
                        $('#noi').removeClass('d-none');
                        var paragraph = document.getElementById("noid");

                        paragraph.textContent = response.error;
                        console.log(response.error);
                    }
                    if (response.status == "true" && response.password == null) {
                        $('#noi').addClass('d-none');
                        $('#password').removeClass('d-none');
                        $('#passwordtwo').removeClass('d-none');
                        console.log(response);

                    }

                },
                error: function(error) {
                    console.log(error);
                }
            });

        });
    </script> --}}
    <script src="{{ asset('front/login/js/main.js') }}"></script>

</body>

</html>
