@extends('admin.layout.template')
@section('title', $title)
@section('admin-content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Detail Room - {{ $room_category->name }}</h1>

        <div class="row">
            <div class="col-3">
                <div class="card shadow">
                    <div class="card-body">
                        <label>Cover</label>
                        <div>
                            <img src="{{ asset('images/room_categories-photo/' . $room_category->cover) }}" class="border img-preview" style="object-fit: cover;max-width: 200px;width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>About</th>
                                        <th>Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $room_category->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{!! $room_category->description !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Room Total</td>
                                        <td>{{ $room_category->room->count() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Room Image</td>
                                        <td><a href="{{ route('admin.room-category.image', ['id' => $room_category->id]) }}">{{ $room_category->image->count() }} Picture</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
