@extends('layouts.app')
@section('title', 'Bank Book')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>Bank Book</div>
        </div>
        <div class="card-body">
            @include('includes.alerts')
            <form action="{{ route('bank_book.export') }}" id="search_form" target="_blank" method="get">
                @method("GET")
                @push('extra_fields')
                    <div class="card">
                        <div class="card-header">Accounts</div>
                        <div class="card-body">
                            @livewire('vouchers.searchable-dropdown',[
                            'data' => $accounts_list,
                            'name' => 'accounts_list',
                            ])
                        </div>
                    </div>
                    @if ($errors->has('accounts_list'))
                        <span class="text-danger">{{ $errors->first('accounts_list') }}</span>
                    @endif
                @endpush
                @include('includes.form_body') {{-- with extra_fields section --}}
        </form>
    </div>
@endsection