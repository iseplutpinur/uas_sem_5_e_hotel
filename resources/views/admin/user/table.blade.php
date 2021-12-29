<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($users->count())
                @foreach ($users as $user)
                    <tr>
                        <td>
                            @if ($user->photo)
                                <img src="{{ asset('images/users-photo/' . $user->photo) }}" style="width: 100px;height: 100px;;object-fit: cover" class="border">
                            @else
                                <img src="{{ asset('images/default.png') }}" style="width: 100px;height: 100px;;object-fit: cover" class="border">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $user->id }}"><i class="fas fa-trash"></i></button>
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
    {{ $users->links() }}
</div>
