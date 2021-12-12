<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Name</th>
                <th>Number</th>
                <th>Owner</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($payment_methods->count())
                @foreach ($payment_methods as $payment_method)
                    <tr>
                        <td>
                            @if ($payment_method->logo)
                                <img src="{{ asset('images/payment_method-photo/' . $payment_method->logo) }}" style="max-width: 250px; max-height: 70px" class="border">
                            @else
                                <img src="{{ asset('images/default.png') }}" style="width: 100px;height: 100px;;object-fit: cover" class="border">
                            @endif
                        </td>
                        <td>{{ $payment_method->name }}</td>
                        <td>{{ $payment_method->number }}</td>
                        <td>{{ $payment_method->owner }}</td>
                        <td>
                            <a href="{{ route('admin.payment-method.edit', ['id' => $payment_method->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $payment_method->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">No data found.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{ $payment_methods->links() }}
</div>
