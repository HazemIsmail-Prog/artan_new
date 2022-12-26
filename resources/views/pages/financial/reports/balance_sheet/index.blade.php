@extends('layouts.app')
@section('title', 'Balance Sheet')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>Balance Sheet</div>
        </div>
        <div class="card-body">
            @include('includes.alerts')
            <form action="{{ route('balance_sheet.export') }}" id="search_form" target="_blank" method="get">
                @method("GET")
                @include('includes.form_body')
            </form>
        </div>
    </div>
@endsection
