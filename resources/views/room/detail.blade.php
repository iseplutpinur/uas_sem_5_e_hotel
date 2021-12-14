@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="container">
        <h2 class="fw-bold mb-0">{{ $room->name }}</h2>
        <p class="text-muted fw-bold">{!! $room->description !!}</p>

        <div>
            <h4>Room Details</h4>
            <div class="row">
                <div class="col-3">
                    @if ($room->cover)
                        <img src="{{ asset('images/room_categories-photo/' . $room->cover) }}" class="border" style="object-fit: cover;max-width: 250px;width: 100%;">
                    @else
                        <img src="{{ asset('images/default.png') }}" class="border" style="object-fit: cover;max-width: 250px;width: 100%;">
                    @endif
                </div>
                <div class="col-6">
                    <h4>Facility</h4>
                    <ul>
                        @foreach ($facilities as $facility)
                            <li><i class="{{ $facility->icon }}"></i> {{ $facility->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-3">
                    <p class="mb-0">*start from</p>
                    <h4>Rp. {{ number_format($room->price) }} /Night</h4>
                    <button class="btn btn-success w-100 btn-book" data-id="{{ Auth::user()->id }}">Book Now!</button>
                </div>
            </div>

            <div>
                <h4>Room Images</h4>
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="background: rgb(1,0,19);background: linear-gradient(351deg, rgba(1,0,19,1) 30%, rgba(0,0,0,1) 35%, rgba(63,67,68,1) 100%);">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            @if ($room->cover)
                                <img src="{{ asset('images/room_categories-photo/' . $room->cover) }}" class="d-block w-100" style="width: 100%; height:400px;object-fit: contain;">
                            @else
                                <img src="{{ asset('images/default.png') }}" class="d-block w-100" style="width: 100%; height:400px;object-fit: contain;">
                            @endif
                        </div>
                        @foreach ($room->image as $room_image)
                            <div class="carousel-item">
                                <img src="{{ asset('images/room_category_images-photo/' . $room_image->photo) }}" class="d-block w-100" style="width: 100%; height:400px;object-fit: contain;">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookModalLabel">Booking Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-input">
                        @csrf
                        <input type="text" name="user_id" value="{{ Auth::id() }}">
                        <input type="text" name="room_category_id" value="{{ $room->id }}">
                        <div class="mb-3">
                            <label class="form-label">Check in</label>
                            <input type="date" class="form-control" name="check_in">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Check out</label>
                            <input type="date" class="form-control" name="check_out">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $('.btn-book').click(function(e) {
                e.preventDefault();
                var data = {
                    _token: "{{ csrf_token() }}",
                    id: $(this).data('id')
                };
                $.ajax({
                    url: "{{ route('check.is_rent') }}",
                    method: "POST",
                    data: data,
                    beforeSend: function(e) {},
                    complete: function(e) {},
                    success: function(res) {
                        if (res == true) {
                            toastr['error']('Book failed, you still have an active transaction!');
                        } else if (res == false) {
                            $('#bookModal').modal('show');
                        }
                    },
                    error: function(res) {
                        toastr['error']('Book failed, there is a problem with the server!');
                    }
                });
            });

            $('.form-input').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure to submit this book?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#409AC7',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((res) => {
                    if (res.isConfirmed) {
                        var formData = new FormData(this);
                        $.ajax({
                            url: "{{ route('detail.book') }}",
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
                                    window.location = "{{ route('active-transaction') }}";
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
