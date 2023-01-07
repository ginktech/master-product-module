<?php

namespace Modules\MasterProduct\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterProduct\Models\Product;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $model = Product::with(['category', 'brand']);
            return DataTables::of($model)->make(true);
        }
        return view('masterproduct::pages.products.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        return view('masterproduct::pages.products.form');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'code'      => 'required|unique:products',
            'name'      => 'required',
            'image'     => 'nullable|image',
            'category_id'  => 'nullable|exists:categories,id',
            'brand_id'     => 'nullable|exists:brands,id'
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->image->store('uploads/master-product/products');
        }
        $product = new Product;
        foreach ($validated as $field => $value) {
            $product->{$field} = $value;
        }
        $product->save();
        return redirect()->route('master-product.products.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id) {
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, Product $product) {
        return view('masterproduct::pages.products.form', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Product $product) {
        $validated = $request->validate([
            'code' => [
                'required',
                Rule::unique('products')->ignore($product->id)
            ],
            'name'      => 'required',
            'image'     => 'nullable|image',
            'category_id'  => 'nullable|exists:categories,id',
            'brand_id'     => 'nullable|exists:brands,id'
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->image->store('uploads/master-product/products');
            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
        }
        foreach ($validated as $field => $value) {
            $product->{$field} = $value;
        }
        $product->save();
        return redirect()->route('master-product.products.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id) {
        //
    }
}
