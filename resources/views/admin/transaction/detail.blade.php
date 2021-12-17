@extends('admin.layout.template')
@section('title', $title)
@section('admin-content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Transaction Detail</h1>

        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        @if ($transaction->room_category->cover)
                            <img src="{{ asset('images/room_categories-photo/' . $transaction->room_category->cover) }}" class="border" style="object-fit: cover;max-width: 350px;width: 100%;">
                        @else
                            <img src="{{ asset('images/default.png') }}" class="border" style="object-fit: cover;max-width: 350px;width: 100%;">
                        @endif
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
                            <form class="form-status">
                                @csrf
                                <input type="hidden" name="id" value="{{ $transaction->id }}">
                                <select class="form-control" name="status">
                                    <option value="">Select status</option>
                                    <option value="waiting" @if ($transaction->status == 'waiting') selected @endif>Waiting for confirmation</option>
                                    <option value="payment" @if ($transaction->status == 'payment') selected @endif>Waiting for payment</option>
                                    <option value="canceled" @if ($transaction->status == 'canceled') selected @endif>Canceled</option>
                                    <option value="active" @if ($transaction->status == 'active') selected @endif>Active</option>
                                    <option value="inactive" @if ($transaction->status == 'inactive') selected @endif>Inactive / Ended</option>
                                </select>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $('select[name="status"]').change(function() {
                $('.form-status').submit();
            });

            $('.form-status').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.transaction.update-status') }}",
                    method: "POST",
                    data: formData,
                    beforeSend: function(e) {},
                    complete: function(e) {},
                    success: function(res) {
                        toastr['success']('Transaction status changed!');
                    },
                    error: function(res) {
                        toastr['error']('Update failed, there is a problem with the server!');
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        </script>
    @endpush
@endsection
