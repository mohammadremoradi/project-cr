<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('front.layouts.head-tag')
    @yield('title')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <div class="content-wrapper">

            @include('front.layouts.header')
            @include('front.layouts.sidebar')

            @yield('content')

        </div>
        @include('front.layouts.script')
        @yield('script')

        <section class="content-header">
            <div class="container-fluid">
                <section class="toast-wrapper flex-row-reverse">
                    @include('admin.layouts.toast')
                    {{-- @include('admin.layouts.sweet_alert_error')
                    @include('admin.layouts.sweet_alert_success') --}}
                </section>
            </div>
        </section>

</body>

</html>
