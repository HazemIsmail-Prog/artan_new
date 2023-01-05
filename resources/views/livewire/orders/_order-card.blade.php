<div class="card shadow-sm overflow-hidden" style="width: 600px">
    <div class="card-body p-0">

        <div class=" d-flex flex-column h-100">
            <div class="p-3 flex-fill">
                {{-- Order Details --}}
                <div class="d-flex h-100">
                    <div class=" flex-fill border-end border-2 me-2">
                        <div><strong>{{ $order->c_name }}</strong></div>
                        <div>{{ $order->c_mobile }}</div>
                        <div>{{ $order->notes }}</div>
                    </div>
                    <div>
                        <div class=" text-success fs-5 {{ $order->amount - $order->total_payments == 0 ? 'text-decoration-line-through' : ''}} "><strong>{{ $order->amount }}</strong>  KWD</div>
                        <div class=" fw-bolder" >{{ $order->order_datetime->format('d/m/Y') }}</div>
                        <div style="font-size: .7rem">{{ $order->order_datetime->format('h:i A') }}</div>
                        <div class=" badge bg-secondary d-block">{{ $order->user->name }}</div>
                        @if ($order->payments->count() > 0)
                            <a class="btn btn-outline-dark btn-sm d-block mt-1" data-bs-toggle="collapse"
                                href="#collapse{{ $order->id }}" role="button" aria-expanded="false"
                                aria-controls="collapse{{ $order->id }}">
                                Paid : {{ $order->total_payments }}
                            </a>
                        @endif
                    </div>
                </div>
                {{-- Order Details --}}
    
            </div>
            {{-- Payments --}}
            <div wire:ignore.self class="collapse" id="collapse{{ $order->id }}">
                @foreach ($order->payments as $payment)
                <div class="card shadow-sm m-1">
                    <div class="card-body py-1">
                        <div class=" d-flex justify-content-between align-items-center">
                            <div class=" badge bg-success">
                                <div>{{ $payment->amount }} KWD</div>
                                <div>{{ $payment->type }}</div>
                            </div>
                            <div>
                                <div style="font-size: .8rem;">{{ $payment->created_at->format('d/m/Y') }}</div>
                                <div style=" font-size:.7rem;">{{ $payment->created_at->format('h:i A') }}</div>
                            </div>
                            <div class=" badge bg-secondary">{{ $payment->user->name }}</div>
                            <div class="text-end d-flex align-items-center gap-1">
                                <button 
                                    x-data="{}" 
                                    x-on:click="window.livewire.emitTo('orders.payment-modal','show',{{ $order }},{{ $payment }})" 
                                    class="btn btn-sm text-dark"
                                >
                                    <svg style="width: 15px;height: 15px">
                                        <use
                                            xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}">
                                        </use>
                                    </svg>     
                                </button>
                                <form class="d-inline" wire:submit.prevent="delete_payment({{ $payment }})">
                                    <button type="submit" class="btn btn-sm text-danger"
                                        onclick="return confirm('{{ __('messages.delete_r_u_sure') }}')">
                                        <svg style="width: 15px;height: 15px">
                                            <use
                                                xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-trash') }}">
                                            </use>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- Payments --}}

            {{-- Bottom Buttons --}}
            <div class=" d-flex">
                @if (in_array(auth()->user()->type,['admin','user']))
                    <button 
                        x-data="{}" 
                        x-on:click="window.livewire.emitTo('orders.order-modal','show',{{ $order }})" 
                        class="btn btn-sm btn-dark rounded-0 flex-fill"
                    >
                        <svg style="width: 15px;height: 15px">
                            <use
                                xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}">
                            </use>
                        </svg>
                    </button>
                    @if ($order->payments->count() == 0)
                        <form class=" flex-fill" wire:submit.prevent="delete_order({{ $order }})">
                            <button type="submit" class="btn btn-sm btn-danger rounded-0 w-100"
                                onclick="return confirm('{{ __('messages.delete_r_u_sure') }}')">
                                <svg style="width: 15px;height: 15px">
                                    <use
                                        xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-trash') }}">
                                    </use>
                                </svg>
                            </button>
                        </form>
                    @endif
                @endif
                @if ($order->total_payments < $order->amount)
                    <button 
                        x-data="{}" 
                        x-on:click="window.livewire.emitTo('orders.payment-modal','show',{{ $order }})" 
                        class="btn btn-sm btn-success rounded-0 flex-fill"
                    >
                        Pay {{ $order->amount - $order->total_payments }}
                    </button>
                @endif
            </div>
            {{-- Bottom Buttons --}}
        </div>
    </div>
</div>