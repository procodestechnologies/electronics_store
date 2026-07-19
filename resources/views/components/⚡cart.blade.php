<?php

use Livewire\Component;

new class extends Component {
    public function cartItems()
    {
        return session()->get('cart', []);
    }
    public function totalPrice()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            self::dispatch('cartUpdated', message: 'Item removed from cart!');
        }
    }
    public function updateQuantity($productId, $quantity)
    {
        $cart = session()->get('cart', []);
        // if quantity is less than 1, remove the item from the cart
        if ($quantity < 1) {
            self::removeFromCart($productId);
            return;
        }
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
            self::dispatch('cartUpdated', message: 'Cart updated!');
        }
    }
    public function cartTotal()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
};
?>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->cartItems() as $item)
                        <tr>
                            <th scope="row justify-content-center align-items-center">
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                    class="img-fluid rounded" style="width: 60px; height: 60px;">
                            </th>
                            <td>
                                <p class="mb-0 py-4">{{ $item['name'] }}</p>
                            </td>
                            <td>
                                <p class="mb-0 py-4">Kshs. {{ number_format($item['price'], 2) }}</p>
                            </td>
                            <td>
                                <div class="input-group quantity py-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button
                                            wire:click="updateQuantity('{{ $item['id'] }}', {{ $item['quantity'] }} - 1)"
                                            class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0"
                                        value="{{ $item['quantity'] }}" readonly>
                                    <div class="input-group-btn">
                                        <button
                                            wire:click="updateQuantity('{{ $item['id'] }}', {{ $item['quantity'] }} + 1)"
                                            class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 py-4">Kshs. {{ number_format($item['price'] * $item['quantity'], 2) }}
                                </p>
                            </td>
                            <td class="py-4">
                                <button wire:click="removeFromCart('{{ $item['id'] }}')"
                                    class="btn btn-md rounded-circle bg-light border">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="6" class="text-center py-4 justify-content-between">Your cart is empty. <a
                                    href="{{ route('shop') }}"
                                    class="btn btn-primary rounded-pill px-4 py-3 text-uppercase">Continue Shopping</a>
                            </td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
        </div>
        <div class="mt-5">
            <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
            <button class="btn btn-primary rounded-pill px-4 py-3" type="button">Apply Coupon</button>
        </div>
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0">Kshs. {{ number_format($this->cartTotal(), 2) }}</p>
                        </div>
                        {{-- <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <div>
                                <p class="mb-0">Flat rate: $3.00</p>
                            </div>
                        </div> --}}
                        {{-- <p class="mb-0 text-end">Shipping to Ukraine.</p> --}}
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4">Kshs. {{ number_format($this->cartTotal(), 2) }}</p>
                    </div>
                    <button class="btn btn-primary rounded-pill px-4 py-3 text-uppercase mb-4 ms-4"
                        type="button">Proceed Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
