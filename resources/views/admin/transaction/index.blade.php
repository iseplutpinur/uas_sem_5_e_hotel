@extends('admin.layout.template')
@section('title', $title)
@section('admin-content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Transaction</h1>

        <div class="card shadow">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <form class="form-search">
                            @csrf
                        </form>
                    </div>
                    <div class="col" align="right">
                        <button class="btn btn-success"><i class="fas fa-filter"></i></button>
                        <button class="btn btn-primary" onclick="loadTable()"><i class="fas fa-redo"></i></button>
                    </div>
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
                var url = "{{ route('admin.transaction') }}";
                if (page != "") {
                    url += "?page=" + page;
                }
                $.ajax({
                    url: url,
                    method: "POST",
                    data: $('.form-search').serialize(),
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
        </script>
    @endpush
@endsection
