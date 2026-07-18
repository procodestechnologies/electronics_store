<?php

use App\Models\Category;
use Flux\Flux;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    #[Validate('required|string|max:255')]
    public string $name;
    public string $slug;
    #[Validate('nullable|string|max:100000')]
    public string $description;
    #[Validate('nullable|integer|exists:categories,id')]
    public ?int $parent_id;

    public bool $hasParent = false;
    public function submit()
    {
        $data = $this->validate();
        $data['slug'] = Str::slug($this->name);
        $success = Category::create($data);

        if ($success) {
            Flux::toast(text: 'category created successfully', variant: 'success');
        }
        $this->reset();
    }
    public function setHasParent()
    {
        $this->hasParent = true;
    }
    public function categories()
    {
        return Category::all();
    }
};
?>

<div>
    <form wire:submit.prevent="submit">
        <!-- Form fields go here -->
        <flux:input name="name" label="Category Name" class="mb-2" wire:model.live="name" />
        <flux:error class="mb-2 mt-0"></flux:error>
        <flux:checkbox name="hasParent" label="Has Parent Category?" class="mb-3" wire:model.live="hasParent" />
        @if ($hasParent)
            <flux:select wire:model="parent_id" class="mb-3" placeholder="Choose industry...">
                @foreach ($this->categories() as $category)
                    <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                @endforeach
            </flux:select>
        @endif

        <flux:error class="mb-2 mt-0"></flux:error>
        <flux:textarea name="description" label="Category Description" class="mb-2" wire:model.live="description" />
        <flux:error class="mb-2 mt-0"></flux:error>
        <flux:button type="submit" variant="primary">
            Create Category
        </flux:button>
    </form>
</div>
