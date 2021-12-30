@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="container mt-3">
        <h3>Forgot Password</h3>
        <p>Enter your email, we will send a link to reset the password to the email you entered.</p>

        <form class="form-forgot">
            @csrf
            <div class="input-group">
                <input type="email" class="form-control" placeholder="Email" name="email">
                <button class="btn btn-secondary" type="submit">Submit</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $('.form-forgot').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('forgot-password') }}",
                    method: "POST",
                    data: formData,
                    beforeSend: function(e) {},
                    complete: function(e) {},
                    success: function(res) {
                        if (res.status == 'fail') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Email is not registered yet!',
                                confirmButtonColor: '#4e73df'
                            }).then(function() {
                                $('.form-forgot')[0].reset();
                            });
                        } else if (res.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Reset password link will sent to your email!',
                                confirmButtonColor: '#4e73df'
                            }).then(function() {
                                $('.form-forgot')[0].reset();
                            });
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
