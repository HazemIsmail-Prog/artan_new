<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use App\Models\Payment;
use Livewire\Component;

class PaymentModal extends Component
{
    public $show = false;
    public $order;
    public $payment;


    protected $listeners = [
        'show' => 'show',
        'hide' => 'hide'
    ];

    public function show($order, $payment = null)
    {
        $this->resetValidation();
        $this->order = $order;
        $max_amount = $order['amount'] - Order::find($order['id'])->total_payments;
        if (!$payment) {
            $payment['amount'] = $max_amount;
            $payment['max_amount'] = $max_amount;
        } else {
            $payment['max_amount'] = $max_amount + $payment['amount'];
        }
        $this->payment = $payment;
        $this->show = true;
    }

    public function hide()
    {
        $this->show = false;
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
        } else {
            //create
            $currentOrder = Order::find($this->order['id']);
            $currentOrder->payments()->create([
                'amount' => $this->payment['amount'],
                'type' => $this->payment['type'],
            ]);
        }

        $this->reset('payment');
        $this->emitTo('orders.order-index', 'refresh');
        $this->hide();
    }

    public function render()
    {
        return view('livewire.orders.payment-modal');
    }
}
