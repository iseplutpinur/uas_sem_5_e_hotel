@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="container mt-3">
        <h3>Active Transaction</h3>

        @if ($active_transaction)
            <div class="row mt-3">
                <div class="col">
                    @if ($active_transaction->room_category->cover)
                        <img src="{{ asset('images/room_categories-photo/' . $active_transaction->room_category->cover) }}" class="border" style="object-fit: cover;max-width: 350px;width: 100%;">
                    @else
                        <img src="{{ asset('images/default.png') }}" class="border" style="object-fit: cover;max-width: 350px;width: 100%;">
                    @endif
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
                        <li class="fw-bold">Guest count</li>
                        {{ $active_transaction->guest }} Person
                        <li class="fw-bold">Check in on</li>
                        {{ date('d F Y', strtotime($active_transaction->check_in)) }}
                        <li class="fw-bold">Check out on</li>
                        {{ date('d F Y', strtotime($active_transaction->check_out)) }}
                        <li class="fw-bold">Status</li>
                        @if ($active_transaction->status == 'waiting')
                            <span class="badge bg-warning">Waiting for confirmation</span>
                        @elseif ($active_transaction->status == 'payment')
                            <span class="badge bg-primary">Waiting for payment</span>
                            @if ($active_transaction->payment_method)
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#payModal"><i class="fas fa-money-bill-wave"></i> Pay</button>
                            @else
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#paymentMethodModal"><i class="fas fa-dollar-sign"></i> Choose payment method</button>
                            @endif
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

    @if ($active_transaction)
        <!-- modal -->
        <div class="modal fade" id="paymentMethodModal" tabindex="-1" aria-labelledby="paymentMethodModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentMethodModalLabel">Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Choose payment method</h6>
                        <form class="form-payment">
                            @csrf
                            <input type="hidden" name="id" value="{{ $active_transaction->id }}">
                            @foreach ($payment_methods as $payment_method)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method_id" value="{{ $payment_method->id }}">
                                    <label class="form-check-label"><img src="{{ asset('images/payment_method-photo/' . $payment_method->logo) }}" style="object-fit: cover;max-width: 400px;width: 100%;max-height: 80px"></label>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-success float-end">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if ($active_transaction->payment_method_id)
            <div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="payModalLabel">Payment - {{ $active_transaction->payment_method->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="m-0">Via : <span class="fw-bold">{{ $active_transaction->payment_method->name }}</span></p>
                            <p class="m-0">Account Number : <span class="fw-bold">{{ $active_transaction->payment_method->number }}</span></p>
                            <p>Account Owner : <span class="fw-bold">{{ $active_transaction->payment_method->owner }}</span></p>
                            <p class="m-0">Invoice total : <span class="fw-bold">Rp. {{ number_format($active_transaction->room_category->price) }}</span></p>
                            <small class="text-muted">Notes : Please pay the amount that matches the bill. for overpayments the funds will be returned, it's just that it takes a long process.</small>
                            <div class="mt-3">
                                <h6>Submit payment slip</h6>
                                <input type="file" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            });

            $('.form-payment').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('active-transaction.update-payment') }}",
                    method: "POST",
                    data: formData,
                    beforeSend: function(e) {},
                    complete: function(e) {},
                    success: function(res) {
                        $('#paymentMethodModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Payment method selected successfully!',
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
        </script>
    @endpush
@endsection
