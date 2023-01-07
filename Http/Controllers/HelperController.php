<?php

namespace Modules\MasterProduct\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;

class HelperController extends Controller {
    public function select2(Request $request) {
        try {
            $model_name = "\\Modules\\MasterProduct\\Models\\" . $request->model;
            $table_name = (new $model_name)->getTable();
            $fields     = Schema::getColumnListing($table_name);
            $model = $model_name::select('*');
            if ($request->has('term') || $request->has('q')) {
                $term = $request->has('term') ? $request->term : ($request->has('q') ? $request->q : '');
                if (!empty($term)) {
                    foreach ($fields as $field) {
                        $model = $model->orWhere($field, 'LIKE', "%" . $term . "%");
                    }
                }
            }
            return response()->json($model->paginate(), 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
