@extends('admin.layout.template')
@section('title', $title)
@section('admin-content')
    <div class="container-fluid">
        <h1 class="h3 text-gray-800">Authorization Setting</h1>

        <div class="card shadow">
            <form class="form-input">
                @csrf
                <div class="card-header">
                    <div class="row">
                        <div class="col-3">
                            <div class="input-group">
                                <select class="form-control" name="group" onchange="loadTable()">
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="table-data"></div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            loadTable()

            function loadTable() {
                var url = "{{ route('admin.authorization-setting') }}";
                $.ajax({
                    url: url,
                    method: "POST",
                    data: $('.form-input').serialize(),
                    beforeSend: function(e) {},
                    complete: function(e) {},
                    success: function(res) {
                        $('#table-data').html(res);
                        for (let x = 1; x <= 2; x++) {
                            checkChecked(x)
                        };
                    },
                    error: function(res) {}
                });
            }

            $('.form-input').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure to update this data?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#409AC7',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((res) => {
                    if (res.isConfirmed) {
                        var formData = new FormData(this);
                        $.ajax({
                            url: "{{ route('admin.authorization-setting.update') }}",
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
                                    loadTable()
                                });
                            },
                            error: function(res) {},
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    }
                });
            });

            $('#table-data').on('click', '.check-all', function() {
                var id = $(this).data('id');
                toggleCheck(id);
            });

            $('#table-data').on('click', '.check', function() {
                var menu = $(this).data('menu');
                checkChecked(menu);
            });

            function toggleCheck(id) {
                var isChecked = $('#check_' + id).is(":checked");
                if (isChecked === true) {
                    $("#check_" + id + "_1").prop('checked', true);
                    $("#check_" + id + "_2").prop('checked', true);
                    $("#check_" + id + "_3").prop('checked', true);
                    $("#check_" + id + "_4").prop('checked', true);
                } else {
                    $("#check_" + id + "_1").prop('checked', false);
                    $("#check_" + id + "_2").prop('checked', false);
                    $("#check_" + id + "_3").prop('checked', false);
                    $("#check_" + id + "_4").prop('checked', false);
                }
            }

            function checkChecked(menu) {
                var id1 = $("#check_" + menu + "_1").is(":checked");
                var id2 = $("#check_" + menu + "_2").is(":checked");
                var id3 = $("#check_" + menu + "_3").is(":checked");
                var id4 = $("#check_" + menu + "_4").is(":checked");
                if (id1 && id2 && id3 && id4 === true) {
                    $("#check_" + menu).prop('checked', true);
                } else {
                    $("#check_" + menu).prop('checked', false);
                }
            }
        </script>
    @endpush
@endsection
