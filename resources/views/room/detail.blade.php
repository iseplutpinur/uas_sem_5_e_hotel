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
                        <img src="{{ asset('images/room_categories-photo/' . $room->cover) }}">
                    @else
                        <img src="{{ asset('images/default.png') }}">
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
                    <h4>Rp. 1.000.000/ Night</h4>
                    <button class="btn btn-success w-100">Book Now!</button>
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
@endsection
