<div class="row">
    @foreach ($room_category_images as $room_category_image)
        <div class="col-3">
            <div class="card">
                <img src="{{ asset('images/room_category_images-photo/' . $room_category_image->photo) }}" class="card-img-top border">
                <div class="card-body">
                    <button class="btn btn-sm btn-block btn-danger btn-delete" data-id="{{ $room_category_image->id }}">Delete</button>
                </div>
            </div>
        </div>
    @endforeach
</div>
