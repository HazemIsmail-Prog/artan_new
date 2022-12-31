<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;

class OrderModal extends Component
{
    public $show = false;
    public $order;


    protected $listeners = [
        'show'=>'show',
        'hide'=>'hide'
    ];

    public function show($order = null)
    {
        $this->resetValidation();
        if (!$order) {
            $order['order_datetime'] = now()->format('Y-m-d H:i');
        }
        $this->order = $order;
        $this->show = true;
    }

    public function hide()
    {
        $this->show = false;
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
        if (isset($this->order['id'])) {
            //edit
            $currentOrder = Order::find($this->order['id']);
            $currentOrder->update([
                'c_name' => $this->order['c_name'],
                'c_mobile' => $this->order['c_mobile'],
                'order_datetime' => $this->order['order_datetime'],
                'amount' => $this->order['amount'],
                'notes' => $this->order['notes'],
            ]);
        } else {
            //create
            Order::create($this->order);
        }
        $this->reset('order');
        $this->emitTo('orders.order-index' ,'refresh');
        $this->hide();
    }

    public function render()
    {
        return view('livewire.orders.order-modal');
    }
}
