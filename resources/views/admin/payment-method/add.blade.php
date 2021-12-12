@extends('admin.layout.template')
@section('title', $title)
@section('admin-content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Add Payment Method</h1>

        <form class="form-input" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Logo</label>
                                <div class="mb-3">
                                    <img src="{{ asset('images/default.png') }}" class="border img-preview" style="object-fit: cover;max-width: 200px;width: 100%;">
                                </div>
                                <input type="file" class="form-control-file" name="logo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Number</label>
                                <input type="number" class="form-control" name="number">
                            </div>
                            <div class="form-group">
                                <label>Owner</label>
                                <input type="text" class="form-control" name="owner">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('admin.payment-method') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $('.form-input').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure to save this data?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#409AC7',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((res) => {
                    if (res.isConfirmed) {
                        var formData = new FormData(this);
                        $.ajax({
                            url: "{{ route('admin.payment-method.store') }}",
                            method: "POST",
                            data: formData,
                            beforeSend: function(e) {},
                            complete: function(e) {},
                            success: function(res) {
                                Swal.fire({
                                    icon: 'success',
                                    title: res.message,
                                    confirmButtonColor: '#409AC7'
                                }).then(function() {
                                    $('.form-input')[0].reset();
                                    $('.img-preview').attr('src', '{{ asset('images/default.png') }}');
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
                    }
                });
            });

            $('input[name="logo"]').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('.img-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        </script>
    @endpush
@endsection
