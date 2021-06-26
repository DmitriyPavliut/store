<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $productsCount=Product::all()->count();
        $usersCount=User::all()->count();

        $carts = Cart::orderBy('created_at', 'desc')->get();


        return view('admin.home.index',[
            'productsCount'=>$productsCount,
            'usersCount'=>$usersCount,
            'carts'=>$carts
        ]);
    }
}
