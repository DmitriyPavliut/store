<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $productsCount=Product::all()->count();
        $usersCount=User::all()->count();

        return view('admin.home.index',[
            'productsCount'=>$productsCount,
            'usersCount'=>$usersCount,
        ]);
    }
}
