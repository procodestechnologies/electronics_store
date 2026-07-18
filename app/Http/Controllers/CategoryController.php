<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('layouts.dashboard.categories.index');
    }
    public function create()
    {
        return view('layouts.dashboard.categories.create');
    }
    public function edit(Category $category)
    {
        return view('layouts.dashboard.categories.edit', ['category' => $category]);
    }
}
