<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $productsCount = Product::all()->count();
        $usersCount = User::all()->count();

        $carts = Cart::orderBy('created_at', 'desc')->get();


        return view('admin.home.index', [
            'productsCount' => $productsCount,
            'usersCount' => $usersCount,
            'carts' => $this->getCartsArray($carts)
        ]);
    }

    private function getCartsArray($carts)
    {
        $arrayCarts=[];
        foreach ($carts as $cart) {
            $arrayOrders = [];
            foreach ($cart->orders as $order) {
                $order = $order->toArray();
                $arrayOrders[] = $order;

            }
            $cart = $cart->toArray();
            $cart['updated_at'] = date('Y-m-d H:i:s', strtotime($cart['updated_at']));
            $cart['created_at'] = date('Y-m-d H:i:s', strtotime($cart['created_at']));
            $arrayCarts[]=$cart;
        }

        return $arrayCarts;
    }
}
