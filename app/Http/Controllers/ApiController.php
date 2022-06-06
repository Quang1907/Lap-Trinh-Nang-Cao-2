<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'product' => $products
        ]);
    }
}
