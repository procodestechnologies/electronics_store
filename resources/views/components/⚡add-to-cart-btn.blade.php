<?php

use App\Models\Product;
use Flux\Flux;
use Livewire\Component;

new class extends Component {
    public $productId;

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);
        // If product already exists, increment quantity
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            // Add new product to cart array
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->featuredImage->image_path, // Assuming you have a relationship to get the featured image
            ];
        }
        $this->dispatch('cartUpdated', message: ucfirst(strtolower($product->name)) . ' added to cart!');
        session()->put('cart', $cart);
    }
};
?>

<div>
    <a class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4" wire:click="addToCart({{ $productId }})">
        <i class="fas fa-shopping-cart me-2"></i> Add To Cart
    </a>

</div>
