<div>
    @if ($show)
        <div class="modal fade show d-block" style="background-color: #00000099">
            <div class="modal-dialog modal-dialog-centered">
                <div x-on:click.away="window.livewire.emitTo('orders.order-modal','hide')" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ @$order['id'] ? 'Edit' : 'Add' }} Order</h5>
                        <button wire:click="hide" type="button" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="order.c_name">Name</label>
                            <input wire:model="order.c_name" autocomplete="off" type="text" id="order.c_name"
                                class="form-control @error('order.c_name') is-invalid @enderror">
                            @error('order.c_name')
                                <span class="small text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="order.c_mobile">Mobile</label>
                            <input wire:model="order.c_mobile" autocomplete="off" type="number" id="order.c_mobile"
                                class="form-control @error('order.c_mobile') is-invalid @enderror">
                            @error('order.c_mobile')
                                <span class="small text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="order.order_datetime">Date - Time</label>
                            <input wire:model="order.order_datetime" autocomplete="off" type="datetime-local"
                                id="order.order_datetime"
                                class="form-control @error('order.order_datetime') is-invalid @enderror">
                            @error('order.order_datetime')
                                <span class="small text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="order.amount">Amount</label>
                            <input wire:model="order.amount" autocomplete="off" type="number" id="order.amount"
                                class="form-control @error('order.amount') is-invalid @enderror">
                            @error('order.amount')
                                <span class="small text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="order.notes">Notes</label>
                            <input wire:model="order.notes" autocomplete="off" type="text" id="order.notes"
                                class="form-control @error('order.notes') is-invalid @enderror">
                            @error('order.notes')
                                <span class="small text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="hide" type="button" class="btn btn-sm text-danger">Cancel</button>
                        <button wire:click="save_order" type="button" class="btn btn-sm btn-dark">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
