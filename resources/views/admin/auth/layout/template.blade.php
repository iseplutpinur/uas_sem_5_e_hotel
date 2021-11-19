<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sb-admin-2/css/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/css/toastr.min.css') }}">
</head>

<body class="bg-gradient-primary">
    @yield('admin-auth-content')

    <!-- js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('plugins/sb-admin-2/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/sb-admin-2/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
