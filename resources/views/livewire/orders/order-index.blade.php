<div>
    @livewire('orders.order-modal')
    @livewire('orders.payment-modal')
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>Orders ({{ $orders->total() }})</div>
            @if (in_array(auth()->user()->type,['admin','user']))
            <button x-data="{}" x-on:click="window.livewire.emitTo('orders.order-modal','show')" class="btn btn-dark btn-sm">Add Order</button>
            @endif
        </div>
        <div class="card-body">
            <div class="row ">
                <div class="col-md-3 mb-3">
                    <input wire:model="search" placeholder="Search..." class=" form-control form-control-sm" type="text">
                </div>

                <div class="col-md-2 mb-3">
                    <div class="form-group text-start">
                        <input wire:model="dateFilter" type="radio" class="btn-check p-0" value="all" id="allDates" autocomplete="off">
                        <label class="btn btn-sm btn-outline-dark" for="allDates">All</label>

                        <input wire:model="dateFilter" type="radio" class="btn-check p-0" value="old" id="old" autocomplete="off">
                        <label class="btn btn-sm btn-outline-dark" for="old">Old</label>
    
                        <input wire:model="dateFilter" type="radio" class="btn-check" value="future" id="future" autocomplete="off">
                        <label class="btn btn-sm btn-outline-dark" for="future">Future</label>
                    </div>       
                </div>

                <div class="col-md-2 mb-3">
                    <div class="form-group text-start">
                        <input wire:model="paymentFilter" type="radio" class="btn-check p-0" value="all" id="allpayments" autocomplete="off">
                        <label class="btn btn-sm btn-outline-dark" for="allpayments">All</label>

                        <input wire:model="paymentFilter" type="radio" class="btn-check p-0" value="paid" id="paid" autocomplete="off">
                        <label class="btn btn-sm btn-outline-dark" for="paid">Paid</label>
    
                        <input wire:model="paymentFilter" type="radio" class="btn-check" value="unpaid" id="unpaid" autocomplete="off">
                        <label class="btn btn-sm btn-outline-dark" for="unpaid">UnPaid</label>
                    </div>       
                </div>
            </div>
            <div class=" d-flex justify-content-center">{{ $orders->links() }}</div>
            <div class=" d-flex flex-wrap gap-3 justify-content-center">
                @foreach ($orders as $order)
                        @include('livewire.orders._order-card')
                @endforeach
            </div>
            <div class=" d-flex justify-content-center mt-3">{{ $orders->links() }}</div>
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
