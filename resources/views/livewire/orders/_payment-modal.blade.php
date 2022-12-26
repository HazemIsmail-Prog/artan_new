<div wire:ignore.self class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="w-100" autocomplete="off" wire:submit.prevent="save_payment">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Add Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- @include('includes.alerts') --}}
                    <div class="form-group">
                        <label for="payment.amount">Amount</label>
                        <input wire:model="payment.amount" autocomplete="off" type="number" id="payment.amount" min="1" max="{{ @$payment['max_amount'] }}"
                            class="form-control @error('payment.amount') is-invalid @enderror">
                        @error('payment.amount')
                            <span class="small text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group text-center">
                        <input wire:model="payment.type" type="radio" class="btn-check p-0" value="cash" id="success-outlined" autocomplete="off">
                        <label class="btn btn-sm btn-outline-success" for="success-outlined">Cash</label>

                        <input wire:model="payment.type" type="radio" class="btn-check" value="knet" id="danger-outlined" autocomplete="off">
                        <label class="btn btn-sm btn-outline-danger" for="danger-outlined">K-Net</label>

                        @error('payment.type')
                            <div class="small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-sm text-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-dark ">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
