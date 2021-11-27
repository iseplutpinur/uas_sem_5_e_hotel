@extends('admin.layout.template')
@section('title', $title)
@section('admin-content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Add Room</h1>

        <div class="card shadow col-6">
            <div class="card-body">
                <form class="form-input">
                    @csrf
                    <div class="form-group">
                        <label>Room Category</label>
                        <select class="form-control" name="room_category_id">
                            <option value="">Select room category</option>
                            @foreach ($room_categories as $room_category)
                                <option value="{{ $room_category->id }}">{{ $room_category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Room Number</label>
                        <input type="text" class="form-control" name="number">
                    </div>
                    <div class="form-group">
                        <label>Room Floor</label>
                        <input type="text" class="form-control" name="floor">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('admin.room') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $('.form-input').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure to save this data?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#409AC7',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((res) => {
                    if (res.isConfirmed) {
                        var formData = new FormData(this);
                        $.ajax({
                            url: "{{ route('admin.room.store') }}",
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
                                    $('.form-input')[0].reset();
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
        </script>
    @endpush
@endsection
