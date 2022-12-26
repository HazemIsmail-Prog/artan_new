@extends('layouts.app')
@section('title', 'Account Statement')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>Account Statement</div>
        </div>
        <div class="card-body">
            @include('includes.alerts')
            <form action="{{ route('account_statement.export') }}" id="search_form" target="_blank" method="get">
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







































{{-- @section('links')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection --}}









{{-- <div class="form-group">
        <label for="accounts_list">Accounts</label>
        <select required style="width: 100%"
                class="js-example-basic-multiple"
                name="accounts_list[]" id="accounts_list" multiple>
            @foreach ($accounts_list as $account)
                <option value="{{$account->id}}"
                @if (request()->input('accounts_list'))
                    @foreach (request()->input('accounts_list') as $acc)
                        {{$acc == $account->id ? 'selected' : ''}}
                        @endforeach
                    @endif
                >{{$account->name}}</option>
            @endforeach
        </select>
        @if ($errors->has('accounts_list'))
            <span class="text-danger">{{ $errors->first('accounts_list') }}</span>
        @endif
        </div> --}}
