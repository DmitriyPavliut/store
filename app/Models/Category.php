<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function parent_category()
    {
        return $this->hasOne('App\Models\Category','id','parent_id');
    }
}