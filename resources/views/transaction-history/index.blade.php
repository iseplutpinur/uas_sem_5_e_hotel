@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="container mt-3">
        <h3>Transaction History</h3>
        @foreach ($transactions as $transaction)
            @php
                $date_in = new DateTime($transaction->check_in);
                $date_out = new DateTime($transaction->check_out);
                $interval = $date_in->diff($date_out);
                $days = $interval->format('%a');
            @endphp
            <a href="{{ route('transaction-history.detail', ['transaction_history' => $transaction->number]) }}" style="text-decoration: none;color: inherit">
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
                            <div class="col-md-4">
                                <p class="m-0"><span class="fw-bold">Room :</span> {{ $transaction->room_category->name }}</p>
                                <p class="m-0"><span class="fw-bold">Price :</span> Rp. {{ number_format($transaction->room_category->price) }}</p>
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
                            <div class="col-md-2">
                                @if ($transaction->status == 'inactive' && $transaction->is_rated == false)
                                    <form class="form-rating">
                                        @csrf
                                        <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                                        <input type="hidden" name="room_category_id" value="{{ $transaction->room_category->id }}">
                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                        <p class="m-0">Give rating :</p>
                                        <div class="rating">
                                            <span><input type="radio" name="star" id="str5" value="5"><label for="str5"><i class="fas fa-star"></i></label></span>
                                            <span><input type="radio" name="star" id="str4" value="4"><label for="str4"><i class="fas fa-star"></i></label></span>
                                            <span><input type="radio" name="star" id="str3" value="3"><label for="str3"><i class="fas fa-star"></i></label></span>
                                            <span><input type="radio" name="star" id="str2" value="2"><label for="str2"><i class="fas fa-star"></i></label></span>
                                            <span><input type="radio" name="star" id="str1" value="1"><label for="str1"><i class="fas fa-star"></i></label></span>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
                $(".rating input:radio").attr("checked", false);
            });

            $('.rating input').click(function() {
                $(".rating span").removeClass('checked');
                $(this).parent().addClass('checked');
            });

            $('input:radio').change(function() {
                $('.form-rating').submit();
            });

            $('.form-rating').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('transaction-history.rating') }}",
                    method: "POST",
                    data: formData,
                    beforeSend: function(e) {},
                    complete: function(e) {},
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thank you for your rating!',
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

    <style>
        .rating {
            float: left;
        }

        .rating span {
            float: right;
            position: relative;
        }

        .rating span input {
            position: absolute;
            top: 0px;
            left: 0px;
            opacity: 0;
        }

        .rating span:hover~span label,
        .rating span:hover label,
        .rating span.checked label,
        .rating span.checked~span label {
            color: #ffc800;
        }

    </style>
@endsection
