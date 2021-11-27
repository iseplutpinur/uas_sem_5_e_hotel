<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Category</th>
                <th>Number</th>
                <th>Floor</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($rooms->count())
                @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $room->category->name }}</td>
                        <td>{{ $room->number }}</td>
                        <td>{{ $room->floor }}</td>
                        <td>
                            <a href="{{ route('admin.room.edit', ['id' => $room->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $room->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">No data found.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{ $rooms->links() }}
</div>
