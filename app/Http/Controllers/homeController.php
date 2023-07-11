<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->active()
            ->latest('updated_at')
            // return just 8 element === limit(8)
            ->take(8)
            ->get();
        // dd($products->toArray());

        return view('shop.home', ['products' => $products]);
    }
    
}
