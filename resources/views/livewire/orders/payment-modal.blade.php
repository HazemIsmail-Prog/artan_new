<div>
    @if ($show)
        <div class="modal fade show d-block" style="background-color: #00000099">
            <div class="modal-dialog modal-dialog-centered">
                <div x-on:click.away="window.livewire.emitTo('orders.payment-modal','hide')" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ @$order['id'] ? 'Edit' : 'Add' }} Payment</h5>
                        <button wire:click="hide" type="button" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="payment.amount">Amount</label>
                            <input wire:model.defer="payment.amount" autocomplete="off" type="number" id="payment.amount" step="0.001" min="1" max="{{ @$payment['max_amount'] }}"
                                class="form-control @error('payment.amount') is-invalid @enderror">
                            @error('payment.amount')
                                <span class="small text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group text-center">
                            <input wire:model.defer="payment.type" type="radio" class="btn-check p-0" value="cash" id="success-outlined" autocomplete="off">
                            <label class="btn btn-sm btn-outline-success" for="success-outlined">Cash</label>

                            <input wire:model.defer="payment.type" type="radio" class="btn-check" value="knet" id="danger-outlined" autocomplete="off">
                            <label class="btn btn-sm btn-outline-danger" for="danger-outlined">K-Net</label>

                            @error('payment.type')
                                <div class="small text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="hide" type="button" class="btn btn-sm text-danger">Cancel</button>
                        <button wire:click="save_payment" type="button" class="btn btn-sm btn-dark">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
