<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;

new class extends Component {
    use WithFileUploads;
    #[Validate('required|string|max:255')]
    public string $name;
    #[Validate('string|max:100000')]
    public string $description;
    #[Validate('string|max:255')]
    public string $slug;
    #[Validate('string|max:255')]
    public string $sku;
    #[Validate('required|numeric|min:0')]
    public float $price;
    #[Validate('required|integer|min:0')]
    public int $stock;
    #[Validate('required|integer')]
    public int $category_id;
    #[Validate('required|integer')]
    public int $created_by;
    #[Validate('required|integer')]
    public int $brand_id;
    #[Validate('required|image|max:10240')]
    public $featured_image;

    #[Validate('nullable|array')]
    public $product_images = [];
    public function mount()
    {
        $this->sku = $this->sku ?? $this->generateSku();
        $this->stock = $this->stock ?? 100;
        $this->created_by = Auth::user()->id;
    }
    public function createProduct()
    {
        $data = $this->validate();
        $productData = [
            'name' => $data['name'],
            'description' => $data['description'],
            'slug' => $this->slug ?? Str::slug($data['name']),
            'sku' => $this->sku ?? $data['sku'],
            'price' => $data['price'],
            'stock' => $this->stock ?? $data['stock'],
            'category_id' => $data['category_id'],
            'created_by' => $data['created_by'],
            'brand_id' => $data['brand_id'],
        ];
        $product = Product::create($productData);
        if ($data['featured_image']) {
            $product->images()->create([
                'name' => $data['featured_image']->getClientOriginalName(),
                'slug' => Str::slug(pathinfo($data['featured_image']->getClientOriginalName(), PATHINFO_FILENAME)),
                'image_path' => $data['featured_image']->store('products/featured', 'public'),
                'is_featured' => true,
            ]);
        }
        if ($data['product_images']) {
            foreach ($data['product_images'] as $image) {
                $product->images()->create([
                    'name' => $image->getClientOriginalName(),
                    'slug' => Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)),
                    'image_path' => $image->store('products/images', 'public'),
                    'is_featured' => false,
                ]);
            }
        }
        Flux::toast(text: 'Product created successfully!', variant: 'success');
        $this->reset();
    }
    public function generateSku()
    {
        return 'SKU-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
    }
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name ?? '');
    }
};
?>

<div>
    <form wire:submit.prevent="createProduct">
        <flux:input class="mb-2" wire:model="name" wire:click="generateSlug" label="Name"
            placeholder="Enter product name" />
        <flux:input class="mb-2" wire:model="sku" label="SKU" placeholder="Enter product SKU" />
        <flux:input class="mb-2" wire:model="price" label="Price" placeholder="Enter product price" type="number" />
        <flux:input class="mb-2" wire:model="stock" label="Stock" placeholder="Enter product stock" type="number" />
        <flux:select class="mb-2" wire:model="category_id" label="Category">
            @foreach (\App\Models\Category::all() as $category)
                <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
            @endforeach
        </flux:select>
        <flux:select class="mb-2" wire:model="brand_id" label="Brand">
            @foreach (\App\Models\Brand::all() as $brand)
                <flux:select.option value="{{ $brand->id }}">{{ $brand->name }}</flux:select.option>
            @endforeach
        </flux:select>
        <flux:input type="file" class="mb-2" wire:model="featured_image" label="Featured Image" />
        @if ($featured_image)
            <flux:avatar class="mb-2" :src="$featured_image->temporaryUrl()" size="xl" />
        @endif
        <flux:input type="file" class="mb-2" wire:model="product_images" label="Product Images" multiple />
        @if ($product_images)
            <div class="flex flex-wrap gap-2 mb-2">
                @foreach ($product_images as $image)
                    <flux:avatar :src="$image->temporaryUrl()" size="xl" />
                @endforeach
            </div>
        @endif
        <flux:textarea class="mb-2" wire:model="description" label="Description"
            placeholder="Enter product description" />
        <flux:button type="submit" variant="primary">Create Product</flux:button>

    </form>

</div>
