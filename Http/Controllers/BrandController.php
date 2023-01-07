<?php

namespace Modules\MasterProduct\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterProduct\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller {
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $model = Brand::where('id', '!=', null);
            return DataTables::of($model)->make(true);
        }

        return view('masterproduct::pages.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        return view('masterproduct::pages.brands.form');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name'  => 'required|unique:brands',
            'logo'  => 'nullable|image'
        ]);
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->logo->store('uploads/master-product/brands');
        }
        $brand = new Brand;
        foreach ($validated as $field => $value) {
            $brand->{$field} = $value;
        }
        $brand->save();
        // return view('masterproduct::pages.action', [
        //     'title' => 'Success',
        //     'description' => 'Data has been created',
        //     'redirect'  => route('master-product.brands.index')
        // ]);
        return redirect()->route('master-product.brands.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, Brand $brand) {
        //$brand->path = storage_path('app/uploads\master-product\brands\cEDDNwBroyv4bAoAaqSJiCgzqYQy6a9z0adsa3VQ.jpg');
        $brand->isExists = Storage::delete('uploads\master-product\brands\cEDDNwBroyv4bAoAaqSJiCgzqYQy6a9z0adsa3VQ.jpg');
        return response()->json($brand, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, Brand $brand) {
        return view('masterproduct::pages.brands.form', [
            'brand' => $brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Brand $brand) {
        $validated = $request->validate([
            'name' => [
                'required',
                Rule::unique('brands')->ignore($brand->id)
            ],
            'logo'  => 'nullable|image'
        ]);
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->logo->store('uploads/master-product/brands');
            if (Storage::exists($brand->logo)) {
                Storage::delete($brand->logo);
            }
        }
        foreach ($validated as $field => $value) {
            $brand->{$field} = $value;
        }
        $brand->save();
        // return view('masterproduct::pages.action', [
        //     'title' => 'Success',
        //     'description' => 'Data has been updated',
        //     'redirect'  => route('master-product.brands.index')
        // ]);
        return redirect()->route('master-product.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, Brand $brand) {
        $brand->delete();
        if (Storage::exists($brand->logo)) {
            Storage::delete($brand->logo);
        }
        // return view('masterproduct::pages.action', [
        //     'title' => 'Success',
        //     'description' => 'Data has been deleted',
        //     'redirect'  => route('master-product.brands.index')
        // ]);
        return redirect()->route('master-product.brands.index');
    }
}
