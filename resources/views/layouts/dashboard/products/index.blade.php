<x-layouts::app :title="__('Products')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div
            class="relative h-full p-4 flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

            <div class="flex flex-row justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Products</h2>
                <flux:button href="{{ route('admin.products.create') }}" wire:navigate variant="primary">
                    Create Product
                </flux:button>
            </div>

            <flux:spacer class="mt-4" />
            <livewire:dashboard-products-index />
        </div>
    </div>
</x-layouts::app>
