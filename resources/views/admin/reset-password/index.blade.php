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
@endsection
