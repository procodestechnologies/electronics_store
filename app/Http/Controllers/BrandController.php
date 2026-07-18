<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return view('layouts.dashboard.brands.index');
    }
    public function create()
    {
        return view('layouts.dashboard.brands.create');
    }
    public function edit(Brand $brand)
    {
        return view('layouts.dashboard.brands.edit', ['brand' => $brand]);
    }
}
