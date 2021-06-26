<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CatalogController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;

class AjaxController extends Controller
{
    public function index()
    {
        return view('errors.404');
    }

    public function sort(Request $request)
    {
        if (isset($request->category)) {
            $cat = Category::where('titleID', $request->category)->first();
            $products = Product::where('category_id', $cat->id)->orderBy('created_at', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);
            if ($request->orderBy == 'price-low-high') {
                $products = Product::where('category_id', $cat->id)->orderBy('price')->paginate(CatalogController::PAGINATIONCOUNT);
            }
            if ($request->orderBy == 'price-high-low') {
                $products = Product::where('category_id', $cat->id)->orderBy('price', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);
            }
            if ($request->orderBy == 'name-a-z') {
                $products = Product::where('category_id', $cat->id)->orderBy('title')->paginate(CatalogController::PAGINATIONCOUNT);
            }
            if ($request->orderBy == 'name-z-a') {
                $products = Product::where('category_id', $cat->id)->orderBy('title', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);
            }
        } else {
            $products = Product::orderBy('created_at', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);

            if ($request->orderBy == 'price-low-high') {
                $products = Product::orderBy('price')->paginate(CatalogController::PAGINATIONCOUNT);
            }
            if ($request->orderBy == 'price-high-low') {
                $products = Product::orderBy('price', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);
            }
            if ($request->orderBy == 'name-a-z') {
                $products = Product::orderBy('title')->paginate(CatalogController::PAGINATIONCOUNT);
            }
            if ($request->orderBy == 'name-z-a') {
                $products = Product::orderBy('title', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);
            }
        }


        return view('ajax.order-by', [
            'products' => $products
        ])->render();

    }


    public function addToCart(Request $request)
    {
        $product = Product::where('id', $request->id)->first();


        $cart_id = '';
        if (!isset($_COOKIE['cart_id'])) {
            $cart_id = uniqid();

            setcookie('cart_id', $cart_id);
        } else {
            $cart_id = $_COOKIE['cart_id'];
        }


        \Cart::session($cart_id);

        \Cart::add([
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'img' => isset($product->images[0]->img) ? $product->images[0]->img : 'no_image.png'
            ]
        ]);

        return response()->json(\Cart::getContent());

    }

    public function delFromCart(Request $request)
    {
        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($cart_id)->remove($request->id);

        return ['count' => \Cart::session($cart_id)->getTotalQuantity(),
            'allPrice' => \Cart::session($cart_id)->getSubTotal()];

    }

    public function editCart(Request $request)
    {
        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($cart_id)->update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->count,
            ),
        ));

        return ['count' => \Cart::session($cart_id)->getTotalQuantity(),
            'allPrice' => \Cart::session($cart_id)->getSubTotal()];

    }

    public function editCartButton(Request $request)
    {
        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($cart_id)->update($request->id, array(
            'quantity' => $request->count,
        ));

        return ['count' => \Cart::session($cart_id)->getTotalQuantity(),
            'allPrice' => \Cart::session($cart_id)->getSubTotal()];
    }

    public function sendOrder(Request $request)
    {

        $cart = new Cart();
        $cart->name = $request->name;
        $cart->secondName = $request->secondName;
        $cart->street = $request->street;
        $cart->home = $request->home;
        $cart->flat = $request->flat;
        $cart->save();

        foreach (\Cart::session($_COOKIE['cart_id'])->getContent()->toArray() as $item) {
            $order = new Order();
            $order->product_id = $item['id'];
            $order->count = $item['quantity'];
            $cart->orders()->save($order);
            \Cart::session($_COOKIE['cart_id'])->remove($item['id']);
        }

        return true;
    }
}
