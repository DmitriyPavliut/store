<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {

        $products = Product::where('status', '1')->orderBy('created_at', 'desc')->paginate(10);

        return $this->returnView('main', [
            'products' => $this->getProductsArray($products),]);
    }

    private function getProductsArray($products)
    {
        $arrayProducts = [];
        foreach ($products as $product) {

            $arrayImages = $product->images->toArray();
            $arrayCategories = $product->category->toArray();
            $product = $product->toArray();
            $product['updated_at'] = date('Y-m-d H:i:s', strtotime($product['updated_at']));
            $product['created_at'] = date('Y-m-d H:i:s', strtotime($product['created_at']));
            $product['images'] = $arrayImages;
            $product['category']=$arrayCategories;

            $arrayProducts[] = $product;
        }
        return $arrayProducts;
    }
}
