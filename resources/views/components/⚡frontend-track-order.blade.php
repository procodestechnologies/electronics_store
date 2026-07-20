<?php

use App\Models\Order;
use Livewire\Component;

new class extends Component {
    public $order;
    public function mount()
    {
        $this->order();
    }
    public function order()
    {
        $order =  Order::whereOrderNumber($this->order)->first();
        if (empty($order)) {
            abort(404, 'Order not found with order number: ' . $this->order . '!');
        }
        $this->order = $order;
    }
};
?>
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Town</th>
                        <th scope="col">Status</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->order->orderItems as $item)
                    <tr>
                        <th scope="row justify-content-center align-items-center">
                            <p class="mb-0 py-4">{{ $order->email }}</p>
                        </th>
                        <td>
                            <p class="mb-0 py-4">{{ $order->phone }}</p>
                        </td>
                        <td>
                            <p class="mb-0 py-4">{{ $order->address }}</p>
                        </td>
                        <td>
                            <p class="mb-0 py-4">{{ $order->town }}</p>
                        </td>
                        <td class="py-4">
                            <p>{{ $order->status }}</p>
                        </td>
                        <td>
                            <p class="mb-0 py-4">{{ $item['quantity'] }}
                            </p>
                        </td>
                        <td>
                            <p class="mb-0 py-4">{{ number_format($item['total'], 2) }}
                            </p>
                        </td>

                    </tr>

                    @empty
                    <tr class="text-center">
                        <td colspan="6" class="text-center py-4 justify-content-between">Your cart is empty.
                        </td>
                    </tr>
                    @endforelse
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class='font-weight-bolder'>Total</td>
                        <td>Kshs. {{ $order->total }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>