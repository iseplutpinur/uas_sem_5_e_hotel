@extends('admin.layout.template')
@section('title', $title)
@section('admin-content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Transaction Detail</h1>

        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <img src="{{ asset('images/room_categories-photo/' . $transaction->room_category->cover) }}" class="border" style="object-fit: cover;max-width: 350px;width: 100%;">
                    </div>
                    <div class="col">
                        <h5>Room Detail</h5>
                        <ul>
                            <li class="font-weight-bold">Name</li>
                            {{ $transaction->room_category->name }}
                            <li class="font-weight-bold">Description</li>
                            {!! $transaction->room_category->description !!}
                            <li class="font-weight-bold">Price</li>
                            Rp. {{ number_format($transaction->room_category->price) }} /Night
                        </ul>
                    </div>
                    <div class="col">
                        <h5>Transaction Detail</h5>
                        <ul>
                            <li class="font-weight-bold">Booking date</li>
                            {{ date('d F Y H:i', strtotime($transaction->created_at)) }}
                            <li class="font-weight-bold">Booked by</li>
                            {{ $transaction->user->name }}
                            <li class="font-weight-bold">Check in on</li>
                            {{ date('d F Y', strtotime($transaction->check_in)) }}
                            <li class="font-weight-bold">Check out on</li>
                            {{ date('d F Y', strtotime($transaction->check_out)) }}
                            <li class="font-weight-bold">Status</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
