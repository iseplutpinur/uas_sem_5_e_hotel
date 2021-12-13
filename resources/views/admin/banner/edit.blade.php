@extends('admin.layout.template')
@section('title', $title)
@section('admin-content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Banner</h1>

        <form class="form-input" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $banner->id }}">
            <input type="hidden" name="oldPhoto" value="{{ $banner->photo }}">
            <div class="row">
                <div class="col-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Photo</label>
                                <div class="mb-3">
                                    @if ($banner->photo)
                                        <img src="{{ asset('images/banners-photo/' . $banner->photo) }}" class="border img-preview" style="object-fit: cover;max-width: 200px;width: 100%;">
                                    @else
                                        <img src="{{ asset('images/default.png') }}" class="border img-preview" style="object-fit: cover;max-width: 200px;width: 100%;">
                                    @endif
                                </div>
                                <input type="file" class="form-control-file" name="photo">
                                <small class="form-text text-muted">Recommended size: 1110px x 350px</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $banner->name }}">
                            </div>
                            <div>
                                <button type=" submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('admin.banner') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $('.form-input').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure to update this data?',
                    showCancelButton: true,
                    confirmButtonColor: '#409AC7',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((res) => {
                    if (res.isConfirmed) {
                        var formData = new FormData(this);
                        $.ajax({
                            url: "{{ route('admin.banner.update') }}",
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
                                    location.reload();
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
                    }
                });
            });

            $('input[name="photo"]').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('.img-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        </script>
    @endpush
@endsection
