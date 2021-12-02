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
                            @if ($room_category->cover)
                                <img src="{{ asset('images/room_categories-photo/' . $room_category->cover) }}" class="border img-preview" style="object-fit: cover;max-width: 200px;width: 100%;">
                            @else
                                <img src="{{ asset('images/default.png') }}" class="border img-preview" style="object-fit: cover;max-width: 200px;width: 100%;">
                            @endif
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
                <div class="card shadow mt-3">
                    <div class="card-body">
                        <h5>Facility</h5>
                        <ul>
                            {{ $room_category->facility->name }}
                            @foreach ($room_category->facility_id as $item)
                                {{ $item }}
                            @endforeach
                            @foreach ($test as $item)
                                {{ $item }}
                            @endforeach
                            {{-- {{ $room_category_facilities }} --}}
                            {{-- @foreach ($room_category_facilities as $item)
                                {{ $item }}
                            @endforeach --}}
                            {{-- @foreach ($room_category_facilities as $room_category_facility)
                                <li>{{ $room_category_facility->facility }}</li>
                            @endforeach --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
