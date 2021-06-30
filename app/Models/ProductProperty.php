<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    use HasFactory;

    protected $table = 'product_properties';

    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_has_property');
    }

    public function values()
    {
        return $this->hasMany('App\Models\PropertyValue', 'property_id', 'id');
    }
}
