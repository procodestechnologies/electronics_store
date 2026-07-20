<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'price',
        'stock',
        'category_id',
        'brand_id',
        'created_by',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function featuredImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_featured', true);
    }
    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }
}
