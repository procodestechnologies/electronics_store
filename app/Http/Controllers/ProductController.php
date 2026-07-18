<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('layouts.dashboard.products.index');
    }
    public function edit(Product $product)
    {
        return view('layouts.dashboard.products.edit', compact('product'));
    }
    public function create()
    {
        return view('layouts.dashboard.products.create');
    }
    public function show(Product $product)
    {
        return view('layouts.dashboard.products.show', compact('product'));
    }
}
