<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class OrderIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refresh' => 'render',
    ];

    public function delete_order(Order $order)
    {
        $order->delete();
    }

    public function delete_payment(Payment $payment)
    {
        $payment->delete();
    }

    public function render()
    {
        $orders =
            Order::query()
            ->with('user')
            ->with('payments.user')
            ->orderBy('order_datetime')
            ->paginate(6);
        return view('livewire.orders.order-index',['orders'=>$orders])->layout('layouts.livewire_app');
    }
}
