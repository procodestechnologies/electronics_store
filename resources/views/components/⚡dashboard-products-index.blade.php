<?php

use App\Models\Product;
use Livewire\Component;

new class extends Component {
    public function products()
    {
        return Product::paginate(10);
    }
    public function deleteProduct(Product $product)
    {
        $product->delete();
        Flux::toast(text: 'Product deleted successfully.', variant: 'info');
    }
};
?>

<div>
    <flux:table :paginate="$this->products()" class="w-full">
        <flux:table.columns>
            <flux:table.column>Image</flux:table.column>
            <flux:table.column>Name</flux:table.column>
            <flux:table.column>Price</flux:table.column>
            <flux:table.column>Actions</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse ($this->products() as $product)
                <flux:table.row>
                    <flux:table.cell>
                        <flux:avatar :src="asset('storage/' . $product->featuredImage->image_path)"
                            alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded" />
                    </flux:table.cell>
                    <flux:table.cell class='truncate'>{{ $product->name }}</flux:table.cell>
                    <flux:table.cell>Kshs. {{ $product->price }}</flux:table.cell>
                    <flux:table.cell>

                        <flux:button icon="eye" href="{{ route('admin.products.show', $product->id) }}"
                            wire:navigate variant="primary" color="blue">
                            View
                        </flux:button>
                        <flux:button icon="pencil-square" href="{{ route('admin.products.edit', $product->id) }}"
                            wire:navigate variant="primary" color="emerald">
                            Edit
                        </flux:button>
                        <flux:button icon="trash" wire:confirm="Are you sure you want to delete this product?"
                            wire:click="deleteProduct({{ $product->id }})" wire:loading.attr="disabled"
                            wire:target="deleteProduct({{ $product->id }})" wire:navigate variant="primary"
                            color="red">
                            Delete
                        </flux:button>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="5" class="text-center text-gray-500 dark:text-gray-400">
                        No products found.
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>
</div>
