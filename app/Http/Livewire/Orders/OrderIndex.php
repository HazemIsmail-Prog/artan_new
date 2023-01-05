<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class OrderIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $dateFilter = 'all';
    public $paymentFilter = 'all';

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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedDateFilter()
    {
        $this->resetPage();
    }
    public function updatedPaymentFilter()
    {
        $this->resetPage();
    }

    public function render()
    {

        $orders =
            Order::query()
            ->with('user')
            ->with('payments.user')
            ->orderBy('order_datetime')
            ->when($this->search, function ($q) {
                $q->where('c_name', 'like', '%' . $this->search . '%');
                $q->orWhere('c_mobile', 'like', '%' . $this->search . '%');
            })
            ->when($this->dateFilter == 'future', function ($q) {
                $q->where('order_datetime', '>=', now());
            })
            ->when($this->dateFilter == 'old', function ($q) {
                $q->where('order_datetime', '<', now());
            })
            ->when($this->paymentFilter == 'paid', function ($q) {
                $q->whereHas('payments', function ($query) {
                    $query->selectRaw('sum(amount)')
                        ->groupBy('order_id')
                        ->havingRaw('sum(amount) = orders.amount');
                });
            })
            ->when($this->paymentFilter == 'unpaid', function ($q) {
                $q->where(function ($q) {
                    $q->doesntHave('payments');
                    $q->orWhereHas('payments', function ($query) {
                        $query->selectRaw('sum(amount)')
                            ->groupBy('order_id')
                            ->havingRaw('sum(amount) < orders.amount');
                    });
                });
            })
            ->paginate(6);
        return view('livewire.orders.order-index', ['orders' => $orders])->layout('layouts.livewire_app');
    }
}
