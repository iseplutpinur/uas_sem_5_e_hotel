<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Transaction Number</th>
                <th>Room Category</th>
                <th>User</th>
                <th>Star</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($ratings->count())
                @foreach ($ratings as $rating)
                    <tr>
                        <td>{{ $rating->transaction->number }}</td>
                        <td>{{ $rating->room_category->name }}</td>
                        <td>{{ $rating->user->name }}</td>
                        <td><i class="fas fa-star" style="color: #ffc800;"></i>{{ $rating->star }}</td>
                        <td>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $rating->id }}"><i class="fas fa-trash"></i></button>
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
    {{ $ratings->links() }}
</div>
