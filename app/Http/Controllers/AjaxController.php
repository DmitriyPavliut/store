<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CatalogController;
use App\Models\Product;
use App\Models\Category;

class AjaxController extends Controller
{
    public function sort(Request $request)
    {
        if ($request->ajax()) {
            if(isset($request->category)){
                $cat = Category::where('titleID',$request->category)->first();
                $products = Product::where('category_id',$cat->id)->orderBy('created_at', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);
                if ($request->orderBy == 'price-low-high') {
                    $products = Product::where('category_id',$cat->id)->orderBy('price')->paginate(CatalogController::PAGINATIONCOUNT);
                }
                if ($request->orderBy == 'price-high-low') {
                    $products = Product::where('category_id',$cat->id)->orderBy('price', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);
                }
                if ($request->orderBy == 'name-a-z') {
                    $products = Product::where('category_id',$cat->id)->orderBy('title')->paginate(CatalogController::PAGINATIONCOUNT);
                }
                if ($request->orderBy == 'name-z-a') {
                    $products = Product::where('category_id',$cat->id)->orderBy('title', 'desc')->paginate(CatalogController::PAGINATIONCOUNT);
                }
            }
            else {
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
        } else {
            return view('errors.404');
        }
    }
}
