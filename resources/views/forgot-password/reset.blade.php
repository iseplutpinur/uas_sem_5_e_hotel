@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="container mt-3">
        <h3>Reset Password</h3>

        <form class="form-reset">
            @csrf
            <input type="hidden" name="token" value="{{ $_GET['token'] }}">
            <input type="hidden" name="id" value="{{ $_GET['id'] }}">
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password">
            </div>
            <button type="submit" class="btn btn-sm btn-success">Submit</button>
        </form>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $('.form-reset').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('reset-password') }}",
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
                            window.location.replace("{{ route('home') }}");

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
        </script>
    @endpush
@endsection
