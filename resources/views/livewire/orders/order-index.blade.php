<div>
    @include('livewire.orders._order-modal')
    @include('livewire.orders._payment-modal')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>Orders</div>
            @if (in_array(auth()->user()->type,['admin','user']))
                <button wire:click="showOrderModal()" type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#formModal">
                    Add Order
                </button>
            @endif
        </div>
        <div class="card-body">
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
