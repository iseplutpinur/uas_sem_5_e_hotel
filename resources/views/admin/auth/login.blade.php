@extends('admin.auth.layout.template')
@section('title', $title)
@section('admin-auth-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form class="user form-login">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Username" name="username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="rememberCheck" name="remember_me">
                                                <label class="custom-control-label" for="rememberCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">Login</button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $('.form-login').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.login') }}",
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
                                window.location.replace('{{ route('admin.dashboard') }}');
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
        </script>
    @endpush
@endsection
