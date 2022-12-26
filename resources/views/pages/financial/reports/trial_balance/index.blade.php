@extends('layouts.app')
@section('title', 'Trial Balance')
@section('content')
    <div class="card">
        <!-- Card Header - Dropdown -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>Trial Balance</div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('trial_balance.export') }}" id="search_form" target="_blank" method="get">
                @method("GET")
                @include('includes.form_body')
            </form>
        </div>
    </div>
@endsection
