<?php

use App\Models\Category;
use Flux\Flux;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public Category $category;
    #[Validate('required|string|max:255')]
    public string $name;
    public string $slug;
    #[Validate('nullable|string|max:100000')]
    public string $description;
    #[Validate('nullable|integer|exists:categories,id')]
    public ?int $parent_id;

    public bool $hasParent = false;
    public function mount(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description;
        $this->parent_id = $category->parent_id;
        if ($this->parent_id) {
            $this->hasParent = true;
        }
    }
    public function submit()
    {
        $data = $this->validate();
        $this->category->slug = Str::slug($this->name);
        $success = $this->category->update($data);

        if ($success) {
            Flux::toast(text: 'Category edited successfully', variant: 'success');
        }
    }
    public function setHasParent()
    {
        $this->hasParent = true;
    }
    public function categories()
    {
        return Category::where('id', '!=', $this->category->id)->get();
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
        <flux:button icon="pencil-square" type="submit" variant="primary" color="green">
            Update Category
        </flux:button>
    </form>
</div>
