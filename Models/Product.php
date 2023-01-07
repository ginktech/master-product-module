<?php

namespace Modules\MasterProduct\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model {
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory() {
        return \Modules\MasterProduct\Database\factories\ProductFactory::new();
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function brand() {
        return $this->belongsTo(Brand::class);
    }
}
