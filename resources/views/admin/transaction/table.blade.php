<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Booking Date</th>
                <th>Transaction Number</th>
                <th>Booked by</th>
                <th>Room Category</th>
                <th>Guest</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ date('d F Y H:i', strtotime($transaction->created_at)) }}</td>
                    <td></td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ $transaction->room_category->name }}</td>
                    <td>{{ $transaction->guest }} Person</td>
                    <td>
                        @if ($transaction->status == 'waiting')
                            <span class="badge badge-warning">Waiting for confirmation</span>
                        @elseif ($transaction->status == 'canceled')
                            <span class="badge badge-danger">Canceled</span>
                        @elseif ($transaction->status == 'inactive')
                            <span class="badge badge-secondary">Inactive / Ended</span>
                        @elseif($transaction->status == 'active')
                            <span class="badge badge-success">Active</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.transaction.detail', ['id' => $transaction->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
