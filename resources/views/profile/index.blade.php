@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="container mt-3">
        <h3>Profile</h3>

        <div class="row">
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <div>
                            <center>
                                <form class="form-photo" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    @if ($user->photo)
                                        <img src="{{ asset('images/users-photo/' . $user->photo) }}" style="width: 200px;height: 200px;;object-fit: cover;border-radius: 50%" class="border">
                                    @else
                                        <img src="{{ asset('images/default.png') }}" style="width: 200px;height: 200px;;object-fit: cover;border-radius: 50%" class="border">
                                    @endif
                                    <label class="btn btn-sm btn-secondary d-block mt-3" for="photo"><i class="fas fa-camera"></i> Change profile</label>
                                    <input type="hidden" name="oldPhoto" class="d-none" value="{{ $user->photo }}">
                                    <input type="file" id="photo" name="photo" class="d-none">
                                </form>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">
                        <form class="form-profile">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                            <button type="submit" class="btn btn-sm btn-success float-end">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <form class="form-password">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Old password</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New password</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm new password</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <button type="submit" class="btn btn-sm btn-success float-end">Change password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $('input[name="photo"]').change(function() {
                $('.form-photo').submit();
            });

            $('.form-photo').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('profile.update-photo') }}",
                    method: "POST",
                    data: formData,
                    beforeSend: function(e) {},
                    complete: function(e) {},
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: res.message,
                            confirmButtonColor: '#409AC7'
                        }).then(function() {
                            window.location.reload();
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
