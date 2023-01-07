<?php

namespace Modules\MasterProduct\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterProduct\Models\Brand;
use Modules\MasterProduct\Models\Category;
use Modules\MasterProduct\Models\Product;

class MasterProductController extends Controller {
    public function index(Request $request) {
        $counts = [
            (object)[
                'title'     => 'Products',
                'volume'    => Product::count(),
                'route'     => 'master-product.products.index'
            ],
            (object)[
                'title'     => 'Brands',
                'volume'    => Brand::count(),
                'route'     => 'master-product.brands.index'
            ],
            (object)[
                'title'     => 'Categories',
                'volume'    => Category::count(),
                'route'     => 'master-product.categories.index'
            ]
        ];
        // return response()->json($counting, 200, [], \JSON_PRETTY_PRINT);
        return view('masterproduct::pages.index', [
            'counts' => $counts
        ]);
    }
}
