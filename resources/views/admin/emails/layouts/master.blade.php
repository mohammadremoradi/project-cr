<!doctype html>
<html lang="fa" dir="">

<head>

    @include('admin.emails.layouts.head-tag')
    @yield('head-tag')

</head>

<body>

    <!-- start header -->
    @include('admin.emails.layouts.header')
    <!-- end header -->


    <!-- start main one col -->
    <main id="main-body-one-col" class="main-body">
        @yield('content')
    </main>
    <!-- end main one col -->


    <!-- start footer -->
    @include('admin.emails.layouts.footer')
    <!-- end footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


</body>

</html>
