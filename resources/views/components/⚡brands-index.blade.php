<?php

use App\Models\Brand;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    #[On('brandDeleted')]
    public function brands()
    {
        return Brand::with('products')->get();
    }
    public function deleteBrand(Brand $brand)
    {
        $brand->delete();
        $this->dispatch('brandDeleted');
        Flux::toast(text: 'Brand deleted successfully', variant: 'success');
    }
};
?>

<div class="grid  grid-cols-4 gap-2 md:grid-cols-3 sm:grid-cols-1">
    @php
        $colors = ['emerald', 'green',  'yellow', 'teal', 'indigo', 'purple', 'gray'];
    @endphp
    @foreach ($this->brands() as $index => $brand)
        <flux:card class="bg-{{ $colors[$index % count($colors)] }}-500 w-fit">
            <flux:heading title="Brand 1" description="Description for Brand 1">
                {{ $brand->name }}
            </flux:heading>
            <flux:spacer class="mt-2" />
            <flux:text>
                <strong class="dark:text-white text-black">{{ $brand->products->count() }} Products</strong>
            </flux:text>
            <flux:spacer class="mt-4" />
            <flux:text>
                <p class="dark:text-white text-black">{{ $brand->description }}</p>
            </flux:text>
            {{-- action buttons --}}
            <flux:spacer class="mt-4" />
            <div class="flex flex-row gap-2 w-fit">
                <flux:button href="{{ route('brands.edit', $brand) }}" wire:navigate variant="primary">
                    Edit
                </flux:button>
                <flux:button icon="trash" wire:confirm="Are you sure you want to delete this brand?" wire:click="deleteBrand({{ $brand->id }})" wire:navigate variant="primary" color="red">
                    Delete
                </flux:button>
            </div>
        </flux:card>
    @endforeach
</div>
