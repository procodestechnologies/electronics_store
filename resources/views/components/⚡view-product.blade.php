<?php

use Livewire\Component;

new class extends Component {
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }
    public function getStockStatusProperty()
    {
        if ($this->product->stock > 10) {
            return ['label' => 'In Stock', 'color' => 'green'];
        } elseif ($this->product->stock > 0) {
            return ['label' => 'Low Stock', 'color' => 'yellow'];
        } else {
            return ['label' => 'Out of Stock', 'color' => 'red'];
        }
    }
};
?>
<div>
    <div class="max-w-full mx-auto px-2 sm:px-6 lg:px-8 py-8">

        <!-- Main Product Card -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-2 lg:p-8">

            <!-- Left Column: Images -->
            <div class="space-y-4">
                <!-- Main Featured Image -->
                <div class="relative aspect-square w-full overflow-hidden rounded-xl bg-gray-100 dark:bg-gray-800">
                    @if ($product->featuredImage)
                        <img src="{{ Storage::url($product->featuredImage->image_path) }}" alt="{{ $product->name }}"
                            class="h-full w-full object-cover object-center">
                    @else
                        <div class="flex h-full w-full items-center justify-center">
                            <svg class="h-24 w-24 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif

                    <!-- Stock Badge -->
                    <div class="absolute top-4 right-4">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                @if ($this->stockStatus['color'] === 'green') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                @elseif($this->stockStatus['color'] === 'yellow') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif
                            ">
                            <span
                                class="w-1.5 h-1.5 rounded-full mr-1.5 
                                    @if ($this->stockStatus['color'] === 'green') bg-green-600
                                    @elseif($this->stockStatus['color'] === 'yellow') bg-yellow-600
                                    @else bg-red-600 @endif
                                "></span>
                            {{ $this->stockStatus['label'] }}
                        </span>
                    </div>
                </div>

                <!-- Thumbnail Gallery -->
                @if ($product->images && $product->images->count() > 0)
                    <div class="grid grid-cols-4 gap-3">
                        @foreach ($product->images as $image)
                            <div
                                class="aspect-square w-full overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800 cursor-pointer hover:ring-2 hover:ring-blue-500 transition-all">
                                <img src="{{ Storage::url($image->image_path) }}" alt="{{ $product->name }} thumbnail"
                                    class="h-full w-full object-cover object-center"
                                    onclick="document.querySelector('.featured-image').src = this.src">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right Column: Product Details -->
            <div class="flex flex-col space-y-6">
                <!-- Product Header -->
                <div>
                    <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                        <span>SKU: {{ $product->sku }}</span>
                        <span>•</span>
                        <span>Category: {{ $product->category?->name ?? 'Uncategorized' }}</span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $product->name }}</h1>
                    @if ($product->brand)
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Brand: {{ $product->brand->name }}
                        </p>
                    @endif
                </div>

                <!-- Price -->
                <div class="flex items-baseline gap-3">
                    <span
                        class="text-4xl font-bold text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</span>
                    @if ($product->compare_price)
                        <span
                            class="text-lg text-gray-400 line-through">${{ number_format($product->compare_price, 2) }}</span>
                        <span class="text-sm font-medium text-green-600 dark:text-green-400">
                            {{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}%
                            OFF
                        </span>
                    @endif
                </div>

                <!-- Stock Info -->
                <div class="flex items-center gap-4 text-sm">
                    <span class="text-gray-600 dark:text-gray-300">Stock: <strong>{{ $product->stock }}</strong>
                        units</span>
                    @if ($product->stock > 0)
                        <span class="text-green-600 dark:text-green-400">✓ Ready to ship</span>
                    @endif
                </div>

                <!-- Divider -->
                <flux:separator class="my-2" />

                <!-- Description -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">
                        Description</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $product->description }}</p>
                </div>

                <!-- Additional Info -->
                <div class="grid grid-cols-2 gap-4 bg-gray-50 dark:bg-gray-800/50 rounded-lg p-4">
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Created By</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $product->createdBy?->name ?? 'Admin' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Added On</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $product->created_at->format('M d, Y') }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    @if ($product->stock > 0)
                        <button
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Add to Cart
                        </button>
                    @else
                        <button disabled
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-400 font-medium rounded-lg cursor-not-allowed">
                            Out of Stock
                        </button>
                    @endif

                    <button
                        class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 font-medium rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        Wishlist
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
