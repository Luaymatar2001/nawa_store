<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with([
            "title" => "index categories",
            "categories" => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request, Category $category)
    {
        $result = $category->create($request->all());
        return redirect()->back()->with('status', $result != null ? 1 : 0);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::where('id', '=', $id)->firstOrFail();
        return view('admin.categories.edit')->with('category', $categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // $categories = $category->findOrFail($id);
        $result = $category->update($request->all());
        return redirect()->back()->with('status', $result != null ? 1 : 0);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Category $categories)
    {
        $result = $categories->destroy($id);
        return redirect()->back()->with('status', $result != null ? 1 : 0);
    }
}
