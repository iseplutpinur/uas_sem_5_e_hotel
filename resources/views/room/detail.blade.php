@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">

            </div>
            <div class="col-6">
                {{ $room->name }}
            </div>
        </div>
    </div>
@endsection
