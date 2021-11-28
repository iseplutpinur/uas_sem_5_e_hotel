<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/swiper/css/swiper-bundle.min.css') }}">
</head>

<body>
    @include('layout.topbar')

    @yield('content')

    @include('layout.footer')

    <!-- modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-login">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="mb-3">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="rememberCheck" name="remember_me">
                                <label class="custom-control-label" for="rememberCheck">Remember Me</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Login</button>
                        <div class="row mt-1">
                            <div class="col-6">
                                <small>Not registered? <a role="button" class="register-href text-decoration-none">Create an account</a></small>
                            </div>
                            <div class="col-6 text-end">
                                <small><a href="#" class="text-decoration-none">Forgot password</a></small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-register">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Fullname" name="name">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Register</button>
                        <div class="row mt-1">
                            <div class="col">
                                <small>Already have an account? <a role="button" class="login-href text-decoration-none">Login</a></small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('plugins/swiper/js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript">
        $('.register-href').click(function() {
            $('#loginModal').modal('hide');
            $('#registerModal').modal('show');
        });

        $('.login-href').click(function() {
            $('#registerModal').modal('hide');
            $('#loginModal').modal('show');
        });

        $('.form-login').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('login') }}",
                method: "POST",
                data: formData,
                beforeSend: function(e) {},
                complete: function(e) {},
                success: function(res) {
                    if (res.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login success!',
                            confirmButtonColor: '#4e73df'
                        }).then(function() {
                            window.location.replace('{{ route('home') }}');
                        });
                    } else {
                        toastr['error']('Invalid account.');
                    }
                },
                error: function(res) {
                    $.each(res.responseJSON.errors, function(id, error) {
                        toastr['error'](error);
                    });
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        $('.form-register').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('register') }}",
                method: "POST",
                data: formData,
                beforeSend: function(e) {},
                complete: function(e) {},
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: res.message,
                        confirmButtonColor: '#4e73df'
                    }).then(function() {
                        $('#registerModal').modal('hide');
                        $('#loginModal').modal('show');
                    });
                },
                error: function(res) {
                    $.each(res.responseJSON.errors, function(id, error) {
                        toastr['error'](error);
                    });
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        $('.btn-logout').click(function() {
            Swal.fire({
                icon: 'question',
                title: 'Are you sure want to logout?',
                confirmButtonColor: '#4e73df',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                showCancelButton: true
            }).then(function(res) {
                if (res.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Logout success!',
                        confirmButtonColor: '#4e73df'
                    }).then(function() {
                        window.location.replace('{{ route('logout') }}');
                    });
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
