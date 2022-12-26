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

    public $order;
    public $payment;

    public function showOrderModal($order = null)
    {
        $this->resetValidation();
        if(!$order){
            $order['order_datetime'] = now()->format('Y-m-d H:i');
        }
        $this->order = $order;
    }

    public function showPaymentModal($order , $payment = null)
    {
        $this->resetValidation();
        $this->order = $order;
        $max_amount = $order['amount'] - Order::find($order['id'])->total_payments;
        if(!$payment){
            $payment['amount'] = $max_amount;
            $payment['max_amount'] = $max_amount;
        }else{
            $payment['max_amount'] = $max_amount + $payment['amount'];
        }
        $this->payment = $payment;
        // dd($this->payment);
    }

    public function save_order()
    {
        $this->validate([
            'order.c_name' => ['required'],
            'order.c_mobile' => ['required'],
            'order.order_datetime' => ['required'],
            'order.amount' => ['required'],
            'order.notes' => ['nullable'],
        ]);
        if(isset($this->order['id'])){
            //edit
            $currentOrder = Order::find($this->order['id']);
            $currentOrder->update([
                'c_name' => $this->order['c_name'],
                'c_mobile' => $this->order['c_mobile'],
                'order_datetime' => $this->order['order_datetime'],
                'amount' => $this->order['amount'],
                'notes' => $this->order['notes'],
            ]);
        }else{
            //create
            Order::create($this->order);
        }
        $this->reset('order');
        $this->dispatchBrowserEvent('hide-form');
    }

    public function save_payment()
    {
        $this->validate([
            'payment.amount' => 'required',
            'payment.type' => 'required',
        ]);
        if (isset($this->payment['id'])) {
            //edit
            $currentPayment = Payment::find($this->payment['id']);
            $currentPayment->update([
                'amount' => $this->payment['amount'],
                'type' => $this->payment['type'],
            ]);

        }else{
            //create
            $currentOrder = Order::find($this->order['id']);
            $currentOrder->payments()->create([
                'amount' => $this->payment['amount'],
                'type' => $this->payment['type'],
            ]);
        }

        $this->reset('payment');
        $this->dispatchBrowserEvent('hide-form');
    }

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
