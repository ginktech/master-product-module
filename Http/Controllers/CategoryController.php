<?php

namespace Modules\MasterProduct\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\MasterProduct\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller {
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $model = Category::where('id', '!=', null);
            return DataTables::of($model)->make(true);
        }
        return view('masterproduct::pages.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        return view('masterproduct::pages.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request) {
        $request->merge([
            'slug' => $request->name
        ]);
        $validated = $request->validate([
            'name'  => 'required',
            'slug'  => 'required|unique:categories'
        ]);
        $category = new Category;
        foreach ($validated as $field => $value) {
            $category->{$field} = $value;
        }
        $category->save();
        return redirect()->route('master-product.categories.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id) {
        return view('masterproduct::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, Category $category) {
        return view('masterproduct::pages.categories.form', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Category $category) {
        $request->merge([
            'slug' => $request->name
        ]);
        $validated = $request->validate([
            'name'  => 'required',
            'slug'  => [
                'required',
                Rule::unique('categories')->ignore($category->id)
            ]
        ]);
        foreach ($validated as $field => $value) {
            $category->{$field} = $value;
        }
        $category->save();
        return redirect()->route('master-product.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, Category $category) {
        $category->delete();
        return redirect()->route('master-product.categories.index');
    }
}
