@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="container mt-3">
        <h3>Transaction History - {{ $transaction->number }}</h3>

        @php
            $addon_price = 0;
            foreach ($facilities as $facility) {
                $addon_price += $facility->price;
            }
            $date_in = new DateTime($transaction->check_in);
            $date_out = new DateTime($transaction->check_out);
            $interval = $date_in->diff($date_out);
            $days = $interval->format('%a');
        @endphp
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="d-none d-md-block d-lg-block d-xl-block">
                            @if ($transaction->room_category->cover)
                                <img src="{{ asset('images/room_categories-photo/' . $transaction->room_category->cover) }}" class="border" style="object-fit: cover;max-height: 100px; height: 100%;">
                            @else
                                <img src="{{ asset('images/default.png') }}" class="border" style="object-fit: cover;max-height: 100px; height: 100%;">
                            @endif
                        </div>
                        <div class="d-md-none d-lg-none d-xl-none">
                            @if ($transaction->room_category->cover)
                                <img src="{{ asset('images/room_categories-photo/' . $transaction->room_category->cover) }}" class="border" style="object-fit: cover;width: 100%;">
                            @else
                                <img src="{{ asset('images/default.png') }}" class="border" style="object-fit: cover;width: 100%;">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="m-0"><span class="fw-bold">Transaction number :</span> {{ $transaction->number }}</p>
                        <p class="m-0"><span class="fw-bold">Booking date :</span> {{ date('d F Y H:i', strtotime($transaction->created_at)) }}</p>
                        <p class="m-0"><span class="fw-bold">Check in :</span> {{ date('d F Y', strtotime($transaction->check_in)) }}</p>
                        <p class="m-0"><span class="fw-bold">Check out :</span> {{ date('d F Y', strtotime($transaction->check_out)) }}</p>
                        <p class="m-0"><span class="fw-bold">Total days :</span> {{ $days }} Days</p>
                    </div>
                    <div class="col-md-2">
                        <p class="m-0"><span class="fw-bold">Addon Facility :</p>
                        <ul>
                            @foreach ($facilities as $facility)
                                <li><i class="{{ $facility->icon }}"></i> {{ $facility->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <p class="m-0"><span class="fw-bold">Room :</span> {{ $transaction->room_category->name }}</p>
                        <p class="m-0"><span class="fw-bold">Price :</span> Rp. {{ number_format($transaction->room_category->price) }}</p>
                        <p class="m-0"><span class="fw-bold">Total Price:</span> Rp. {{ number_format($days * $transaction->room_category->price + $addon_price) }}</p>
                        <p class="m-0"><span class="fw-bold">Guest :</span> {{ $transaction->guest }}</p>
                        <p class="m-0"><span class="fw-bold">Status :</span>
                            @if ($transaction->status == 'waiting')
                                <span class="badge bg-warning">Waiting for confirmation</span>
                            @elseif ($transaction->status == 'payment')
                                <span class="badge bg-primary">Waiting for payment</span>
                            @elseif ($transaction->status == 'confirmation')
                                <span class="badge bg-secondary">Waiting for payment confirmation</span>
                            @elseif ($transaction->status == 'canceled')
                                <span class="badge bg-danger">Canceled</span> <i class="fas fa-info-circle text-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Reason for canceled here."></i>
                            @elseif ($transaction->status == 'inactive')
                                <span class="badge bg-secondary">Inactive / Ended</span>
                            @elseif ($transaction->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('transaction-history') }}" class="btn btn-secondary mt-3">Back</a>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            });
        </script>
    @endpush
@endsection
