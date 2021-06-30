<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        return $this->returnView('cart.index',[
            'cartList'=>isset($_COOKIE['cart_id'])?\Cart::session($_COOKIE['cart_id'])->getContent()->toArray() : [],
            'supPrice'=>isset($_COOKIE['cart_id']) ?\Cart::session($_COOKIE['cart_id'])->getSubTotal():"0",
        ]);
    }

}
