<?php

use App\Models\Brand;
use App\Models\Category;
use Flux\Flux;
use Livewire\Component;

new class extends Component {
    public function categories()
    {
        return Category::with('products')->get();
    }
    public function deleteCategory(Category $category)
    {
        $category->delete();
        $this->dispatch('categoryDeleted');
        Flux::toast(text: 'Category deleted successfully', variant: 'success');
    }
};
?>

<div class="grid grid-cols-4 md:grid-cols-3 sm:grid-cols-1 gap-4">
    @php
        $colors = ['emerald', 'green', 'red', 'yellow', 'teal', 'indigo', 'purple', 'gray'];
    @endphp
    @forelse ($this->categories() as $index => $category)
        <flux:card class="bg-{{ $colors[$index % count($colors)] }}-500">
            <flux:heading title="Category 1" description="Description for Category 1">
                {{ $category->name }}
            </flux:heading>
            <flux:spacer class="mt-2" />
            <flux:text>
                <strong class="dark:text-white text-black">{{ $category->products->count() }} Products</strong>
            </flux:text>
            <flux:spacer class="mt-4" />
            <flux:text class="dark:text-white">
                Parent:
                <p class="text-sm dark:text-white truncate">{{ $category->parent()?->name ?? ' No Parent Category' }}</p>
            </flux:text>
            <flux:text>
                <p class="text-sm dark:text-white truncate">{{ $category->description }}</p>
            </flux:text>
            {{-- action buttons  --}}
            <flux:spacer class="mt-4" />
            <div class="flex flex-row gap-2">
                <flux:button href="{{ route('categories.edit', $category) }}" wire:navigate variant="primary">
                    Edit
                </flux:button>
                <flux:button icon="trash" wire:confirm="Are you sure you want to delete this category?" wire:click="deleteCategory({{ $category->id }})" variant="primary" color="red">
                    Delete
                </flux:button>
            </div>
        </flux:card>
    @empty
        <div class="col-span-4 flex flex-col items-center justify-center gap-2 mt-5">
            <flux:heading title="No Categories" description="There are no categories available.">
                No Categories
            </flux:heading>
            <flux:text>
                <p>There are no categories available. Please create a category to get started.</p>
            </flux:text>
        </div>
    @endforelse
</div>
