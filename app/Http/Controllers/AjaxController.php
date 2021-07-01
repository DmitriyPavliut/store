<?php

namespace App\Http\Controllers;

use App\Models\PropertyValue;
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
        return $this->returnView('errors.404');
    }

    public function sort(Request $request)
    {
        if (isset($request->category)) {
            $cat = Category::where('titleID', $request->category)->first();
            $arChildren = $cat->child->toArray();
            $arrayIdCategory = $this->editCategoryArr($arChildren);
            $arrayIdCategory[] = $cat->id;

            $products = Product::where('status', '1')->whereIn('category_id', $arrayIdCategory)->orderBy('created_at', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);

            if ($request->orderBy == 'price-low-high') {
                $products = Product::where('status', '1')->whereIn('category_id', $arrayIdCategory)->orderBy('price')->paginate(CatalogController::PAGINATIONCOUNT);
            }

            if ($request->orderBy == 'price-high-low') {
                $products = Product::where('status', '1')->whereIn('category_id', $arrayIdCategory)->orderBy('price', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);
            }

            if ($request->orderBy == 'name-a-z') {
                $products = Product::where('status', '1')->whereIn('category_id', $arrayIdCategory)->orderBy('title')->paginate(CatalogController::PAGINATIONCOUNT);
            }

            if ($request->orderBy == 'name-z-a') {
                $products = Product::where('status', '1')->whereIn('category_id', $arrayIdCategory)->orderBy('title', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);
            }

        } else {
            $products = Product::where('status', '1')->orderBy('created_at', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);

            if ($request->orderBy == 'price-low-high') {
                $products = Product::where('status', '1')->orderBy('price')->paginate(CatalogController::PAGINATIONCOUNT);
            }
            if ($request->orderBy == 'price-high-low') {
                $products = Product::where('status', '1')->orderBy('price', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);
            }
            if ($request->orderBy == 'name-a-z') {
                $products = Product::where('status', '1')->orderBy('title')->paginate(CatalogController::PAGINATIONCOUNT);
            }
            if ($request->orderBy == 'name-z-a') {
                $products = Product::where('status', '1')->orderBy('title', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);
            }
        }


        return view('ajax.order-by', [
            'products' => $products
        ])->render();

    }


    public function addToCart(Request $request)
    {
        //return json_decode($request->properties);
        $product = Product::where('id', $request->id)->first();


        $cart_id = '';
        if (!isset($_COOKIE['cart_id'])) {
            $cart_id = uniqid();

            setcookie('cart_id', $cart_id);
        } else {
            $cart_id = $_COOKIE['cart_id'];
        }

        $id=$product->id;
        $arProperties = [];
        if (isset($request->properties)) {
            foreach ($request->properties as $values) {
                $id.='_'.$values;
                $value = PropertyValue::find($values)->toArray();
                $key = PropertyValue::find($values)->property->toArray();
                $arProperties[$key['name']] = $value['value'];
            }
        }


        \Cart::session($cart_id);

        \Cart::add([
            'id' => $id,
            'prod_id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'quantity' => $request->count,
            'attributes' => [
                'img' => isset($product->images[0]->img) ? $product->images[0]->img : 'no_image.png',
                'url' => "/catalog/" . $product->category['titleID'] . '/' . $product['titleID'] . '_' . $product['id'],
                'properties' => $arProperties
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
        $cart->fullPrice = \Cart::session($_COOKIE['cart_id'])->getSubTotal();
        $cart->save();

        foreach (\Cart::session($_COOKIE['cart_id'])->getContent()->toArray() as $item) {
            $order = new Order();
            $order->product_id = $item['prod_id'];
            $order->count = $item['quantity'];
            $cart->orders()->save($order);
            \Cart::session($_COOKIE['cart_id'])->remove($item['prod_id']);
        }

        return true;
    }

    protected function editCategoryArr($tree, $depth = 0)
    {
        $array = [];
        if (is_array($tree)) {
            foreach ($tree as $node) {
                array_push($array, $node['id']);

                if (isset($node['children']))
                    $array = array_merge($array, $this->editCategoryArr($node['children'], $depth + 1));
            }
        }
        return $array;

    }
}
