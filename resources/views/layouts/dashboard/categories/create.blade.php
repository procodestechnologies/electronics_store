<x-layouts::app :title="__('Create Category')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border p-4 border-neutral-200 dark:border-neutral-700">
            <div class="flex flex-row justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Create Category</h2>
                <flux:button href="{{ route('categories.index') }}" wire:navigate variant="primary">
                    All Categories
                </flux:button>
            </div>

            <flux:spacer class="mt-4" />
            <div class="grid grid-cols-1 gap-4">
                <livewire:create-category />
            </div>
        </div>
    </div>
</x-layouts::app>
