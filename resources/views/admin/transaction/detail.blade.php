@extends('admin.layout.template')
@section('title', $title)
@section('admin-content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Transaction Detail : {{ $transaction->number }}</h1>

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
                                <input type="hidden" name="user_id" value="{{ $transaction->user->id }}">
                                <input type="hidden" name="id" value="{{ $transaction->id }}">
                                <select class="form-control" name="status">
                                    <option value="">Select status</option>
                                    <option value="waiting" @if ($transaction->status == 'waiting') selected @endif>Waiting for confirmation</option>
                                    <option value="payment" @if ($transaction->status == 'payment') selected @endif>Waiting for payment</option>
                                    <option value="confirmation" @if ($transaction->status == 'confirmation') selected @endif>Waiting for payment confirmation</option>
                                    <option value="canceled" @if ($transaction->status == 'canceled') selected @endif>Canceled</option>
                                    <option value="active" @if ($transaction->status == 'active') selected @endif>Active</option>
                                    <option value="inactive" @if ($transaction->status == 'inactive') selected @endif>Inactive / Ended</option>
                                </select>
                            </form>
                            @if ($transaction->status == 'confirmation')
                                <a href="{{ asset('images/transactions-photo/' . $transaction->payment_slip) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Check payment slip</a>
                            @endif
                        </ul>
                    </div>
                </div>
                <div align="right">
                    <a href="{{ route('admin.transaction') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>

        @if ($transaction->status == 'active')
            <div class="card shadow mt-3">
                <div class="card-body">
                    <h4>Room</h4>
                    @if (!$transaction->room_id)
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#setRoomModal">Set active room for this transaction</button>
                    @else
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#updateRoomModal">Change room</button>
                            <button type="button" class="btn btn-sm btn-danger btn-endroom" data-id="{{ $transaction->room->id }}" data-transaction_id="{{ $transaction->id }}">End Room</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Floor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $transaction->room->number }}</td>
                                        <td>{{ $transaction->room->floor }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- modal -->
    <div class="modal fade" id="setRoomModal" tabindex="-1" aria-labelledby="setRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="setRoomModalLabel">Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-room">
                        @csrf
                        <input type="hidden" name="id" value="{{ $transaction->id }}">
                        <div class="form-group">
                            <select class="form-control" name="room_id">
                                <option value="">Select room</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">Number : {{ $room->number }} | Floor : {{ $room->floor }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateRoomModal" tabindex="-1" aria-labelledby="updateRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRoomModalLabel">Change Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($transaction->room)
                        <form class="form-change">
                            @csrf
                            <input type="hidden" name="id" value="{{ $transaction->id }}">
                            <input type="hidden" name="oldRoom" value="{{ $transaction->room->id }}">
                            <div class="form-group">
                                <select class="form-control" name="room_id">
                                    <option value="">Select room</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}">Number : {{ $room->number }} | Floor : {{ $room->floor }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    @else
                        <p>No active room to change!</p>
                    @endif
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
                        location.reload();
                    },
                    error: function(res) {
                        toastr['error']('Update failed, there is a problem with the server!');
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            $('.form-room').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.transaction.update-room') }}",
                    method: "POST",
                    data: formData,
                    beforeSend: function(e) {},
                    complete: function(e) {},
                    success: function(res) {
                        $('#setRoomModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Room selected successfully!',
                            confirmButtonColor: '#4e73df'
                        }).then(function() {
                            window.location.reload();
                        });
                    },
                    error: function(res) {
                        $.each(res.responseJSON.errors, function(id, error) {
                            toastr['error'](error);
                        });
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            $('.form-change').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.transaction.change-room') }}",
                    method: "POST",
                    data: formData,
                    beforeSend: function(e) {},
                    complete: function(e) {},
                    success: function(res) {
                        $('#setRoomModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Room changed successfully!',
                            confirmButtonColor: '#4e73df'
                        }).then(function() {
                            window.location.reload();
                        });
                    },
                    error: function(res) {
                        $.each(res.responseJSON.errors, function(id, error) {
                            toastr['error'](error);
                        });
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            $('.btn-endroom').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var transaction_id = $(this).data('transaction_id');
                var url = "{{ route('admin.transaction.end-room', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    method: "DELETE",
                    data: {
                        _token: $("meta[name='csrf-token']").attr("content"),
                        transaction_id: transaction_id
                    },
                    beforeSend: function(e) {},
                    complete: function(e) {},
                    success: function(res) {
                        window.location.reload();
                    },
                    error: function(res) {
                        toastr['error']('End room failed, there is a problem with the server!');
                    }
                });
            });
        </script>
    @endpush
@endsection
