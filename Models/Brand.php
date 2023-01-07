<?php

namespace Modules\MasterProduct\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model {
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory() {
        return \Modules\MasterProduct\Database\factories\BrandFactory::new();
    }
}
