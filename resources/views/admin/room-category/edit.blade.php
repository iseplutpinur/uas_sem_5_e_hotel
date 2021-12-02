@extends('admin.layout.template')
@section('title', $title)
@section('admin-content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Room Category</h1>

        <ul class="nav nav-pills mb-3">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.room-category.edit', ['id' => $room_category->id]) }}">Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.room-category.image', ['id' => $room_category->id]) }}">Images</a>
            </li>
        </ul>

        <form class="form-input" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $room_category->id }}">
            <div class="row">
                <div class="col-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Cover</label>
                                <div class="mb-3">
                                    @if ($room_category->cover)
                                        <img src="{{ asset('images/room_categories-photo/' . $room_category->cover) }}" class="border img-preview" style="object-fit: cover;max-width: 200px;width: 100%;">
                                    @else
                                        <img src="{{ asset('images/default.png') }}" class="border img-preview" style="object-fit: cover;max-width: 200px;width: 100%;">
                                    @endif
                                </div>
                                <input type="file" class="form-control-file" name="cover">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $room_category->name }}">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="description" value="{{ $room_category->description }}">
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mt-3">
                        <div class="card-body">
                            <h5>Facility</h5>
                            @foreach ($facilities as $facility)
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="addonCheck" name="facility[]" value="{{ $facility->id }}" @if (in_array($facility->id, $room_category->facility_id)) checked @endif>
                                        <label class="form-check-label" for="addonCheck"><i class="{{ $facility->icon }}"></i> {{ $facility->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card shadow">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            <a href="{{ route('admin.room-category') }}" class="btn btn-secondary btn-block">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
