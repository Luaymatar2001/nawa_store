<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
            ->select(['products.*', 'categories.name as category_name'])->paginate(1);
        // dd($product->toArray());
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
            'category' => $category, 'status_options' => Product::status_option()
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

        //بترجع كل الحقول الي صار عليها فاليديتد
        // dd($request->validated());
        $data = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // generate random name for image and set this name in the path 
            //can recive array of dist
            $path = $file->store('storage/product_image', [
                'disk' => 'public'
            ]);
        }
        $data['image'] = $path;
        // $data =  $request->validated();
        $old_image = $product->image;
        //Mass Assingment
        $result = $product->create($data);
        if ($old_image && $result->image = $old_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->back()->with(['status' => $result != null ? 1 : 0]);
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
            'categories' => $category,
            'status_options' => Product::status_option()
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
        $data = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // generate random name for image and set this name in the path 
            //can recive array of dist
            $path = $file->store('storage/product_image', [
                'disk' => 'public'
            ]);
        }
        $data['image'] = $path;
        // $data =  $request->validated();
        $old_image = $product->image;

        //Mass Assingment
        $result = $product->update($data);

        if ($old_image && $product->image = $old_image) {
            Storage::disk('public')->delete($old_image);
        }


        // $result = $product->update($request->all());
        return redirect()->back()->with('status', $result != null ? 1 : 0);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // $result = Product::destroy($id);
        $result = $product->delete();

        return redirect()->back()->with('status', $result != null ? 1 : 0);
    }

    public function trashedProduct()
    {
        $product = Product::onlyTrashed()->paginate(10);
        return view('admin.products.trashed')->with([
            'products' => $product
        ]);
    }
    public function forceDelete($id)
    {
        $product = Product::findOrFail($id);
        $result = Product::forceDeleted($id);
        // dd($product);
        if ($result) {
            Storage::disk('public')->delete($product->image);
        }

        return redirect()->back() > with(['status', 'success']);
    }

    public function restore($id)
    {
        $result = Product::restored($id);
        return redirect()->back();
    }
}
