<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($banners->count())
                @foreach ($banners as $banner)
                    <tr>
                        <td>
                            @if ($banner->photo)
                                <img src="{{ asset('images/banners-photo/' . $banner->photo) }}" style="max-width: 250px; max-height: 70px" class="border">
                            @else
                                <img src="{{ asset('images/default.png') }}" style="width: 100px;height: 100px;;object-fit: cover" class="border">
                            @endif
                        </td>
                        <td>{{ $banner->name }}</td>
                        <td>
                            <a href="{{ route('admin.banner.edit', ['id' => $banner->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $banner->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No data found.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{ $banners->links() }}
</div>
