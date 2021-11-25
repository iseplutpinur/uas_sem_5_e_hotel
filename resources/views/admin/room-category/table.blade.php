<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($room_categories->count())
                @foreach ($room_categories as $room_category)
                    <tr>
                        <td>{{ $room_category->name }}</td>
                        <td>
                            <a href="{{ route('admin.room-category.detail', ['id' => $room_category->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.room-category.edit', ['id' => $room_category->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $room_category->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="2">No data found.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{ $room_categories->links() }}
</div>
