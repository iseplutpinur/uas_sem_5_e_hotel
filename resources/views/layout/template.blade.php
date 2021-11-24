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
                            <input type="text" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Login</button>
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
    <script type="text/javascript">
        $('.register-href').click(function() {
            $('#loginModal').modal('hide');
            $('#registerModal').modal('show');
        });

        $('.login-href').click(function() {
            $('#registerModal').modal('hide');
            $('#loginModal').modal('show');
        });
    </script>
</body>

</html>
