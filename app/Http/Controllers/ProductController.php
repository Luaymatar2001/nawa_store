<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function validates($request, $id = 0)
    {
        $rule = [
            'name' => 'required|string|max:255|min:3',
            'slug' => 'required|unique:products,slug,$id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|min:0',
            'compare_price' => 'nullable|gt:products,price',
            'image' => 'required|file|mimetypes:image/png,image/jpg,image/bmp|max:1024',
            'status' => 'required|in:draft,active,archived',
            'category' => 'required|exists:categories,id',
        ];
        return $request->validate($rule);
    }
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
     * يأخذ قيمة ثابته
     * $product->status = $request->input('status' , 'active');
     * بترجع ال id تبع ال request
     *   $request->route('product');
     * فقط يستدعي الإسم وال slug
     * $request->only(['name', 'slug']);
     * عدا
     * $request->except(['name', 'slug']);

     */
    public function store(ProductRequest $request, Product $product)
    {

        // $this->validates($request);
        //Mass Assingment
        // dd($request->toArray());
        // $data =  $request->validated();

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
    public function update(ProductRequest $request, Product $product)
    {
        // dd($product->toArray());
        // $this->validates($request, $id);
        // $products = $product->findOrFail($id);

        $result = $product->update($request->all());
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
