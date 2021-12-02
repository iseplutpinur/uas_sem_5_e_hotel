<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($facilities->count())
                @foreach ($facilities as $facility)
                    <tr>
                        <td><i class="{{ $facility->icon }}"></i> {{ $facility->icon }}</td>
                        <td>{{ $facility->name }}</td>
                        <td>@if ($facility->price) Rp. {{ number_format($facility->price) }} @else Free @endif @if ($facility->is_addon)  <span class="badge badge-secondary">Addon</span> @endif</td>
                        <td>
                            <a href="{{ route('admin.facility.edit', ['id' => $facility->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $facility->id }}"><i class="fas fa-trash"></i></button>
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
    {{ $facilities->links() }}
</div>
