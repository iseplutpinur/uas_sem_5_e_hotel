<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Reset Link</th>
                <th>Request At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($forgot_passwords->count())
                @foreach ($forgot_passwords as $forgot_password)
                    <tr>
                        <td>{{ $forgot_password->user->name }}</td>
                        <td>{{ $forgot_password->user->email }}</td>
                        <td><input type="text" id="copyText_{{ $forgot_password->id }}" value="{{ route('reset-password') . '?id=' . $forgot_password->user->id . '&token=' . $forgot_password->user->token }}" class="form-control" readonly></td>
                        <td>{{ date('d F Y H:i', strtotime($forgot_password->created_at)) }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="copyText('copyText_{{ $forgot_password->id }}')"><i class="fas fa-copy"></i></button>
                            @if (!$forgot_password->is_sent)
                                <button class="btn btn-sm btn-success btn-check" data-id="{{ $forgot_password->id }}"><i class="fas fa-check"></i></button>
                            @endif
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
    {{ $forgot_passwords->links() }}
</div>
