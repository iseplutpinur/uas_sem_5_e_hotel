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
                <form class="form-input">
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

            });
        </script>
    @endpush
@endsection
