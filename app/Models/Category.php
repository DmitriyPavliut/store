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

    public function child()
    {
        return $this->hasMany('App\Models\Category','parent_id','id')->with('children');
    }

    public function Children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('Children');
    }


}
