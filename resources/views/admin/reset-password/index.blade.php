@extends('admin.layout.template')
@section('title', $title)
@section('admin-content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Reset Password Request</h1>

        <div class="card shadow">
            <div class="card-header">
                <div align="right">
                    <button class="btn btn-primary" onclick="loadTable()"><i class="fas fa-redo"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="table-data"></div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            loadTable()

            function loadTable(page) {
                var url = "{{ route('admin.reset-password') }}";
                if (page != "") {
                    url += "?page=" + page;
                }
                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        _token: $("meta[name='csrf-token']").attr("content")
                    },
                    beforeSend: function(e) {},
                    complete: function(e) {},
                    success: function(res) {
                        $('#table-data').html(res);
                        $(".pagination").on('click', '.page-link', function(e) {
                            e.preventDefault();
                            var url = $(this).attr("href");
                            var page = url.split("=")[1];
                            loadTable(page);
                            return false;
                        });
                    },
                    error: function(res) {}
                });
            }

            function copyText(id) {
                $('#' + id).select();
                document.execCommand("copy");
                alert("Link copied on clipboard!");
            }

            $('#table-data').on('click', '.btn-check', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = "{{ route('admin.reset-password.check', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        _token: $("meta[name='csrf-token']").attr("content")
                    },
                    beforeSend: function(e) {},
                    complete: function(e) {},
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: res.message,
                            confirmButtonColor: '#409AC7'
                        }).then(function() {
                            loadTable();
                        });
                    },
                    error: function(res) {
                        toastr['error']('Check data failed, there is a problem with the server!');
                    }
                });
            });
        </script>
    @endpush
@endsection
