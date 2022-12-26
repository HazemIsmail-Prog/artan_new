<div>
    @include('livewire.users._user-modal')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>Users</div>
            <button wire:click="showUserModal()" type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#formModal">
                Add User
            </button>
            {{-- <div><a class="btn btn-dark btn-sm" href="#">Add User</a></div> --}}
        </div>
        <div class="card-body">
            {{-- @include('includes.alerts') --}}
            <div class="table-responsive">
                <table class="table table-hover table-outline mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Username</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="text-center" nowrap>{{ $user->id }}</td>
                                <td class="text-left" nowrap>{{ $user->name }}</td>
                                <td class="text-left" nowrap>{{ $user->username }}</td>
                                <td class="text-center" nowrap>{{ $user->type }}</td>
                                <td class="text-center" nowrap>
                                    <span class="badge {{ $user->active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $user->active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="text-center" nowrap>
                                    <button wire:click="showUserModal({{ $user }})" type="button" class="btn btn-sm text-dark" data-bs-toggle="modal" data-bs-target="#formModal">
                                        <svg style="width: 15px;height: 15px">
                                            <use
                                                xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}">
                                            </use>
                                        </svg>
                                    </button>
                                    {{-- <a class="text-info btn btn-sm" href="#">
                                        <svg style="width: 15px;height: 15px">
                                            <use
                                                xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}">
                                            </use>
                                        </svg>
                                    </a> --}}
                                    <form class="d-inline" wire:submit.prevent="delete_user({{ $user }})">
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
                        @empty
                            <tr>
                                <td colspan="7">No results</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                {{ $users->links() }}
                            </td>
                        </tr>
                    </tfoot>
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