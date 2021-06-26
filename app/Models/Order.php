<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function prod()
    {
        return $this->hasOne('App\Models\Product','id','product_id');
    }
}
