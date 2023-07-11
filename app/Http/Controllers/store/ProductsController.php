<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\review;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
    }
    public function show($slug)
    {
        $product = Product::where('slug', '=', $slug)->with('productImage')->with('review')->withCount('review')->withSum('review', 'star')->active()->firstOrFail();
        // $review = review::with('product')->whereHas('product', function ($query) use ($slug) {
        //     $query->where(
        //         'slug',
        //         $slug
        //     );
        // })->latest('updated_at')
        //     ->get();
        // dd();
        //أقل
        $rate = floor($product->review_sum_star / $product->review_count);
        return view('shop.products.show')->with('product', $product)->with('avarege_star', $rate);
    }
}
