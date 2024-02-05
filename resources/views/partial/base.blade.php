</html>

<!doctype html>
<html lang="en" class="no-focus">

<head>
    @include('partial.head')
    @stack('css')

    <!-- END Stylesheets -->
</head>

<body>
    @include('partial.sidebar')
    <!-- END Sidebar -->

    <!-- Header -->
    @include('partial.header')
    <!-- END Header -->

    <!-- Main Container -->

    @yield('main')

    <!-- END Main Container -->

    <!-- Footer -->
    @include('partial.footer')
    <!-- END Page Container -->
    @include('partial.corejs')
    @stack('script')


</body>

</html>
