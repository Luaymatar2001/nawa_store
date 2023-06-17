<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $product = Product::leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->select(['products.*', 'categories.name as category_name'])->get();

        return view('admin.products.index')->with([
            "title" => "index product",
            "products" => $product,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.products.create', [
            'category' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {

        $result = $product->create($request->all());
        return redirect()->back()->with('status', $result != null ? 1 : 0);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //تخرج صفحة خطأ
        // abort(404);
        $products = Product::where('id', '=', $id)->firstOrFail();
        $category = Category::all();

        return view('admin.products.edit')->with([
            'products' => $products,
            'categories' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, Product $products)
    {
        $products = $products->findOrFail($id);
        $result = $products->update($request->all());
        return redirect()->back()->with('status', $result != null ? 1 : 0);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = Product::destroy($id);
        return redirect()->back()->with('status', $result != null ? 1 : 0);
    }
}
