<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public const PAGINATIONCOUNT=6;

    public function index(){

        $products = Product::orderBy('created_at', 'desc')->paginate(self::PAGINATIONCOUNT);

        return view('catalog', [
            'products' => $products
        ]);
    }

    public function showCategory(Request $request, $category){
        $cat = Category::where('titleID',$category)->first();

        $products = Product::where('category_id',$cat->id)->paginate(self::PAGINATIONCOUNT);

        return view('catalog',[
            'cat' => $cat,
            'products' => $products,
            //'catarr'=>$cat->id,
            'catarr'=>$cat->children,
        ]);
    }


}
