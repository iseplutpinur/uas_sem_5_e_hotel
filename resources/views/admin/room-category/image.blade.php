@extends('admin.layout.template')
@section('title', $title)
@section('admin-content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Image Room Category</h1>

        <ul class="nav nav-pills mb-3">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.room-category.edit', ['id' => $room_category->id]) }}">Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.room-category.image', ['id' => $room_category->id]) }}">Images</a>
            </li>
        </ul>

        <div class="card shadow">
            <div class="card-body">
                <form class="form-input" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="room_category_id" value="{{ $room_category->id }}">
                    <div class="form-group">
                        <label>Upload Photo</label>
                        <input type="file" class="form-control-file" name="photo">
                    </div>
                </form>
                <div id="images-data"></div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            loadImages()

            function loadImages() {
                $.ajax({
                    url: "{{ route('admin.room-category.images') }}",
                    method: "POST",
                    data: {
                        _token: $("meta[name='csrf-token']").attr("content"),
                        id: '{{ $room_category->id }}'
                    },
                    beforeSend: function(e) {},
                    complete: function(e) {},
                    success: function(res) {
                        $('#images-data').html(res);
                    },
                    error: function(res) {}
                });
            }

            $('input[name=photo]').change(function() {
                $('.form-input').submit();
            });

            $('.form-input').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.room-category.image-store') }}",
                    method: "POST",
                    data: formData,
                    beforeSend: function(e) {},
                    complete: function(e) {},
                    success: function(res) {
                        $('.form-input')[0].reset();
                        loadImages();
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

            $('#images-data').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure to delete this image?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#409AC7',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((res) => {
                    if (res.isConfirmed) {
                        var id = $(this).data('id');
                        var url = "{{ route('admin.room-category.image-delete', ':id') }}";
                        url = url.replace(':id', id);
                        $.ajax({
                            url: url,
                            method: "DELETE",
                            data: {
                                _token: $("meta[name='csrf-token']").attr("content")
                            },
                            beforeSend: function(e) {},
                            complete: function(e) {},
                            success: function(res) {
                                Swal.fire({
                                    icon: 'success',
                                    title: res.message,
                                    confirmButtonColor: '#409AC7'
                                }).then(function() {
                                    loadImages();
                                });
                            },
                            error: function(res) {
                                toastr['error']('Delete data failed, there is a problem with the server!');
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
