<?php

use Livewire\Component;

new class extends Component {
    public string $query;
public $results = [];
    public function results(string $query)
    {
        
    }
};
?>

<div class="search-results">
    {{-- display product links --}}
    <div class="results-list">
        @forelse($results as $product)
            <a href="{{ route('products.show', $product->id) }}" class="product-link">
                <div class="product-item">
                    <h3>{{ $product->name }}</h3>
                    <p class="price">${{ $product->price }}</p>
                </div>
            </a>
        @empty
            <p class="no-results">No products found</p>
        @endforelse
    </div>
</div>
