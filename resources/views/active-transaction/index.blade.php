@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="container">
        <h3>Active Transaction</h3>

        @if ($active_transaction)
            <p>{{ $active_transaction->user->name }}</p>
            <p>{{ $active_transaction->room_category->name }}</p>
            <p>{{ $active_transaction->check_in }}</p>
        @endif
    </div>
@endsection
