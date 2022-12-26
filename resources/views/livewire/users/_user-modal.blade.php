<div wire:ignore.self class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="w-100" autocomplete="off" wire:submit.prevent="save_user">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">{{ @$user['id'] ? 'Edit' : 'Add' }} User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- @include('includes.alerts') --}}

                    <div class="form-group">
                        <label for="user.name">Name</label>
                        <input autocomplete="off" type="text" id="user.name"
                            wire:model="user.name"
                            class="form-control @error('user.name') is-invalid @enderror">
                        @error('user.name')<span class="small text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="user.username">Username</label>
                        <input autocomplete="off" type="text" id="user.username"
                            wire:model="user.username"
                            class="form-control @error('user.username') is-invalid @enderror">
                        @error('user.username')<span
                            class="small text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="user.email">Email</label>
                        <input autocomplete="off" type="user.email" name="user.email" id="user.email"
                            wire:model="user.email"
                            class="form-control @error('user.email') is-invalid @enderror">
                        @error('user.email')<span class="small text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="user.password">Password</label>
                        <input autocomplete="off" type="password" id="user.password"
                            wire:model="user.password"
                            class="form-control @error('user.password') is-invalid @enderror">
                        @error('user.password')<span
                            class="small text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="user.active">Status</label>
                        <div class="form-check">
                            <input wire:model="user.active" class="form-check-input" type="checkbox" id="user.active"
                                checked>
                            <label class="form-check-label" for="user.active">
                                Active
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm text-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-dark">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
