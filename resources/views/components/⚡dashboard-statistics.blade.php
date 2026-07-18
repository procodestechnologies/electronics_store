<?php

use Livewire\Component;

new class extends Component {
    public $totalProducts;
    public $totalBrands;
    public $totalCategories;

    public function mount()
    {
        $this->totalProducts = \App\Models\Product::count();
        $this->totalBrands = \App\Models\Brand::count();
        $this->totalCategories = \App\Models\Category::count();
    }
};
?>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <flux:card title="View Products" class="flex flex-col gap-2 p-4 cursor-pointer" :href="route('admin.products.index')" wire:navigate>
        <flux:heading class="text-sm font-semibold text-gray-700 dark:text-gray-300">
            {{ __('Total Products') }}
        </flux:heading>
        <flux:text class="text-3xl font-bold text-gray-900 dark:text-white">
            {{ $totalProducts }}
        </flux:text>
    </flux:card>
    <flux:card title="View Brands" class="flex flex-col gap-2 p-4 cursor-pointer" :href="route('brands.index')" wire:navigate>
        <flux:heading class="text-sm font-semibold text-gray-700 dark:text-gray-300">
            {{ __('Total Brands') }}
        </flux:heading>
        <flux:text class="text-3xl font-bold text-gray-900 dark:text-white">
            {{ $totalBrands }}
        </flux:text>
    </flux:card>
    <flux:card title="View Categories" class="flex flex-col gap-2 p-4 cursor-pointer" :href="route('categories.index')" wire:navigate>
        <flux:heading class="text-sm font-semibold text-gray-700 dark:text-gray-300">
            {{ __('Total Categories') }}
        </flux:heading>
        <flux:text class="text-3xl font-bold text-gray-900 dark:text-white">
            {{ $totalCategories }}
        </flux:text>
    </flux:card>
</div>
