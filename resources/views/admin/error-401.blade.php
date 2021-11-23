@extends('admin.layout.template')
@section('title', $title)
@section('admin-content')
    <div class="container-fluid">
        <h1 class="d-inline text-warning">401</h1>
        <h1 class="d-inline"><i class="fas fa-exclamation-triangle text-warning"></i> Not Authroized.</h1>
        <p>You are not authorized to access this page. <a href="{{ route('admin.dashboard') }}">Return to dashboard</a></p>
    </div>
@endsection
