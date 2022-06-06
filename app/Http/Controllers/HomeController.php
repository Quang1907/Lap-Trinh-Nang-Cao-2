<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\view\Recusive;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('pages.index', compact('products', 'categories'));
    }

    public function shopDetail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('pages.shop-detail', compact('product'));
    }

    public function shop($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->first();
        return view('pages.shop', compact('category', 'categories'));
    }
}
