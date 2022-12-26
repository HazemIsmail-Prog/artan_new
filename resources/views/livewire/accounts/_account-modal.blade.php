<div wire:ignore.self class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="w-100" autocomplete="off" wire:submit.prevent="save_account">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">{{ @$account['id'] ? 'Edit' : 'Add' }} Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- @include('includes.alerts') --}}
                    <div class="form-group">
                        <label for="account.name">Name</label>
                        <input autocomplete="off" type="text" id="account.name" wire:model="account.name"
                                class="form-control @error('account.name') is-invalid @enderror">
                        @error('account.name')<span class="small text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="account.account_id">Parent Account</label>
                        <select class="form-control @error('account.account_id') is-invalid @enderror" wire:model="account.account_id" id="account.account_id">
                            <option value="">---</option>
                            @foreach ($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                        @error('account.account_id')<span class="small text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="account.usage">Account Usage</label>
                        <select class="form-control @error('account.usage') is-invalid @enderror" wire:model="account.usage" id="account.usage">
                            <option value="">---</option>
                            <option value="assets">Assets</option>
                            <option value="income">Income</option>
                            <option value="expenses">Expenses</option>
                            <option value="liabilities">Liabilities</option>
                            <option value="equity">Equity</option>
                            <option value="bank">Bank</option>
                            <option value="cash">Cash</option>
                            <option value="sales">Sales</option>
                            <option value="cost_of_sales">Cost of Sales - Raw Material</option>
                        </select>
                        @error('account.usage')<span class="small text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="account.active">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                    id="account.active"
                                    wire:model="account.active">
                            <label class="form-check-label" for="account.active">
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
