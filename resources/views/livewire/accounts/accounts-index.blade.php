<div>
    @include('livewire.accounts._account-modal')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>Accounts</div>
            <button wire:click="showAccountModal()" type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#formModal">
                Add Account
            </button>
        </div>
        <div class="card-body">
            @include('includes.alerts')
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Usage</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts->where('account_id',null) as $account)
                            <tr>
                                <td>{{ $account->name }}</td>
                                <td>{{ $account->usage ?? '' }}</td>
                                <td class="text-end">
                                    <button wire:click="showAccountModal(null,{{ $account->id }})" type="button" class="btn text-success btn-sm" data-bs-toggle="modal" data-bs-target="#formModal">
                                        <svg style="width: 15px;height: 15px">
                                            <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-plus') }}">
                                            </use>
                                        </svg>
                                    </button>
                                    <button wire:click="showAccountModal({{ $account }})" type="button" class="text-info btn btn-sm" data-bs-toggle="modal" data-bs-target="#formModal">
                                        <svg style="width: 15px;height: 15px">
                                            <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}">
                                            </use>
                                        </svg>
                                    </button>
                                    <form class="d-inline" wire:submit.prevent="delete_account({{ $account }})">
                                        <button type="submit" class="text-danger btn btn-sm"
                                            onclick="return confirm('{{ __('messages.delete_r_u_sure') }}')">
                                            <svg style="width: 15px;height: 15px">
                                                <use
                                                    xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-trash') }}">
                                                </use>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @include('livewire.accounts._sub-account')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script>
    window.addEventListener('hide-form',event => {
        $("[data-bs-dismiss=modal]").trigger({ type: "click" });
    })
</script>
    
@endpush