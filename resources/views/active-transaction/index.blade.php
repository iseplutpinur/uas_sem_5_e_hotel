@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="container mt-3">
        <h3>Active Transaction</h3>

        @if ($active_transaction)
            <div class="row mt-3">
                <div class="col">
                    <img src="{{ asset('images/room_categories-photo/' . $active_transaction->room_category->cover) }}" class="border" style="object-fit: cover;max-width: 350px;width: 100%;">
                </div>
                <div class="col">
                    <h5>Room Detail</h5>
                    <ul>
                        <li class="fw-bold">Name</li>
                        {{ $active_transaction->room_category->name }}
                        <li class="fw-bold">Description</li>
                        {{ $active_transaction->room_category->description }}
                        <li class="fw-bold">Price</li>
                        Rp. {{ number_format($active_transaction->room_category->price) }} /Night
                    </ul>
                </div>
                <div class="col">
                    <h5>Transaction Detail</h5>
                    <ul>
                        <li class="fw-bold">Booked by</li>
                        {{ $active_transaction->user->name }}
                        <li class="fw-bold">Check in on</li>
                        {{ date('d F Y', strtotime($active_transaction->check_in)) }}
                        <li class="fw-bold">Check out on</li>
                        {{ date('d F Y', strtotime($active_transaction->check_out)) }}
                        <li class="fw-bold">Status</li>
                        @if ($active_transaction->status == 'waiting')
                            <span class="badge bg-warning">Waiting for confirmation</span>
                        @elseif ($active_transaction->status == 'canceled')
                            <span class="badge bg-danger">Canceled</span> <i class="fas fa-info-circle text-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Reason for canceled here."></i>
                        @elseif ($active_transaction->status == 'inactive')
                            <span class="badge bg-secondary">Inactive / Ended</span>
                        @elseif ($active_transaction->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @endif
                    </ul>
                </div>
            </div>
        @else
            <p>You have no active transaction.</p>
        @endif
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            });
        </script>
    @endpush
@endsection
