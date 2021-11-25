@extends('admin.layout.template')
@section('title', $title)
@section('admin-content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Room Category</h1>

        <ul class="nav nav-pills mb-3">
            <li class="nav-item">
                <a class="nav-link active" href="#">Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Images</a>
            </li>
        </ul>

        <div class="card shadow col-6">
            <div class="card-body">
                <form class="form-input">
                    @csrf
                    <input type="hidden" name="id" value="{{ $room_category->id }}">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $room_category->name }}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" value="{{ $room_category->description }}">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('admin.room-category') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
