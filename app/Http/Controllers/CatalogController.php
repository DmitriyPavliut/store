<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public const PAGINATIONCOUNT = 6;

    public function index()
    {

        $products = Product::where('status', '1')->orderBy('created_at', 'desc')->paginate(self::PAGINATIONCOUNT);

        return $this->returnView('catalog', [
            'products' => $this->getProductsArray($products),
            'categoryList' => $this->getCategoryList(),
            'pagination'=>$products->appends(request()->query())
        ]);
    }

    public function showCategory(Request $request, $category)
    {
        $cat = Category::where('titleID', $category)->first();
        $arChildren = $cat->child->toArray();
        $arrayIdCategory = $this->editCategoryArr($arChildren);
        $arrayIdCategory[] = $cat->id;


        $products = Product::where('status', '1')->whereIn('category_id', $arrayIdCategory)->paginate(self::PAGINATIONCOUNT);

        return $this->returnView('catalog', [
            'cat' => $cat,
            'products' => $this->getProductsArray($products),
            'categoryList' => $this->getCategoryList(),
            'pagination'=>$products->appends(request()->query())
        ]);
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

    protected function getCategoryList()
    {
        $cat = Category::where('parent_id', null)->get()->toArray();

        $arChildren = [];
        foreach ($cat as $item) {

            $item['children'] = Category::where('id', $item['id'])->first()->child->toArray();
            $arChildren[] = $item;
        }
        return $arChildren;
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
