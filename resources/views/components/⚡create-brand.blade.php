<?php

use App\Models\Brand;
use Flux\Flux;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    #[Validate('required|string|max:255')]
    public string $name;
    public string $slug;
    #[Validate('nullable|string|max:255')]
    public string $description;
    public function submit()
    {
        $data = $this->validate();
        $data['slug'] = Str::slug($this->name);
        $success = Brand::create($data);

        if ($success) {
            Flux::toast(text: 'brand created successfully', variant: 'success');
        }
        $this->reset();
    }
};
?>

<div>
    <form wire:submit.prevent="submit">
        <!-- Form fields go here -->
        <flux:input name="name" label="Brand Name" class="mb-2" wire:model.live="name" />
        <flux:error class="mb-2 mt-0"></flux:error>
        <flux:textarea name="description" label="Brand Description" class="mb-2" wire:model.live="description" />
        <flux:error class="mb-2 mt-0"></flux:error>
        <flux:button type="submit" variant="primary">
            Create Brand
        </flux:button>
    </form>
</div>
