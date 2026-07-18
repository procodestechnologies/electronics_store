<x-layouts::app :title="__('Create Product')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div
            class="relative h-full flex-1 p-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

            <div class="flex flex-row justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Create Product</h2>
                <flux:button href="{{ route('admin.products.index') }}" wire:navigate variant="primary">
                    All Products
                </flux:button>
            </div>

            <flux:spacer class="mt-4" />
            <livewire:create-product />
        </div>
    </div>
</x-layouts::app>
