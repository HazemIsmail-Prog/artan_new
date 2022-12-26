@foreach ($account->childs as $account)
    <tr>
        <td style=" padding-left: {{ $account->level * 2 }}rem">{{ $account->name }}</td>
        <td>{{ $account->usage ?? '' }}</td>
        <td class="text-end">
            @if ($account->level != 4)
                <button wire:click="showAccountModal(null,{{ $account->id }})" type="button" class="btn text-success btn-sm" data-bs-toggle="modal" data-bs-target="#formModal">
                    <svg style="width: 15px;height: 15px">
                        <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-plus') }}">
                        </use>
                    </svg>
                </button>
            @endif
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
