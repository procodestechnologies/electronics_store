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
};
?>

<div class="container-fluid bg-light overflow-hidden py-5">
    <div class="container py-5">
        <h1 class="mb-4 wow fadeInUp" data-wow-delay="0.1s">Billing details</h1>
        <form action="#">
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">First Name<sup>*</sup></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Last Name<sup>*</sup></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Company Name<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Address <sup>*</sup></label>
                        <input type="text" class="form-control" placeholder="House Number Street Name">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Town/City<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Country<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Mobile<sup>*</sup></label>
                        <input type="tel" class="form-control">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Email Address<sup>*</sup></label>
                        <input type="email" class="form-control">
                    </div>
                    {{-- <div class="form-check my-3">
                        <input type="checkbox" class="form-check-input" id="Account-1" name="Accounts" value="Accounts">
                        <label class="form-check-label" for="Account-1">Create an account?</label>
                    </div> --}}
                    <hr>
                    {{-- 
                    <div class="form-check my-3">
                        <input class="form-check-input" type="checkbox" id="Address-1" name="Address" value="Address">
                        <label class="form-check-label" for="Address-1">Ship to a different address?</label>
                    </div> --}}
                    <div class="form-item">
                        <textarea name="text" class="form-control" spellcheck="false" cols="30" rows="11"
                            placeholder="Order Notes (Optional)"></textarea>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Image</th>
                                    <th scope="col" class="text-start">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($this->cartItems() as $item)
                                    <tr class="text-center">
                                        <th scope="row" class="text-start py-4">
                                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                                class="img-fluid rounded" style="width: 60px; height: 60px;">
                                        </th>
                                        <td class="py-4 text-start">{{ $item['name'] }}</td>
                                        <td class="py-4">Kshs. {{ number_format($item['price'], 2) }}</td>
                                        <td class="py-4 text-center">{{ $item['quantity'] }}</td>
                                        <td class="py-4">Kshs.
                                            {{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </td>
                                    </tr>

                                @empty
                                    <tr class="text-center">
                                        <td colspan="5" class="text-center py-4 justify-content-between">Your cart is
                                            empty.
                                        </td>
                                    </tr>
                                @endforelse


                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-4"></td>
                                    <td class="py-4"></td>
                                    <td class="py-4">
                                        <p class="mb-0 text-dark py-2">Subtotal</p>
                                    </td>
                                    <td class="py-4">
                                        <div class="py-2 text-center border-bottom border-top">
                                            <p class="mb-0 text-dark">Kshs.{{ number_format($this->totalPrice(), 2) }}</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-4">
                                        <p class="mb-0 text-dark text-uppercase py-2">TOTAL</p>
                                    </td>
                                    <td class="py-4"></td>
                                    <td class="py-4"></td>
                                    <td class="py-4">
                                        <div class="py-2 text-center border-bottom border-top">
                                            <p class="mb-0 text-dark">Kshs.{{ number_format($this->totalPrice(), 2) }}</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="button"
                            class="btn btn-primary border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place
                            Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
