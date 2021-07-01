<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyValue extends Model
{
    use HasFactory;

    protected $table = 'properties_values';

    public function products()
    {
        return $this->belongsToMany(Product::class,'products_has_properties');
    }

    public function property()
    {
        return $this->belongsTo('App\Models\ProductProperty');
    }

}
