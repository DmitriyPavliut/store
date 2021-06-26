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

        $products = Product::where('status','1')->orderBy('created_at', 'desc')->paginate(self::PAGINATIONCOUNT);

        return view('catalog', [
            'products' => $products,
            'categoryList'=>$this->getCategoryList()
        ]);
    }

    public function showCategory(Request $request, $category)
    {
        $cat = Category::where('titleID', $category)->first();
        $arChildren = $cat->child->toArray();
        $arrayIdCategory= $this->editCategoryArr($arChildren);
        $arrayIdCategory[]=$cat->id;


        $products = Product::where('status','1')->whereIn('category_id', $arrayIdCategory)->paginate(self::PAGINATIONCOUNT);

        return view('catalog', [
            'cat' => $cat,
            'products' => $products,
            'categoryList'=>$this->getCategoryList()
        ]);
    }

    protected function editCategoryArr($tree, $depth = 0)
    {
        $array = [];
        if (is_array($tree)) {
            foreach ($tree as $node) {
                array_push ($array, $node['id']);

                if (isset($node['children']))
                    $array = array_merge($array, $this->editCategoryArr($node['children'], $depth + 1));
            }
        }
        return $array;

    }

    protected function getCategoryList(){
        $cat = Category::where('parent_id', null)->get()->toArray();

        $arChildren=[];
        foreach ($cat as $item){

            $item['children']=Category::where('id', $item['id'])->first()->child->toArray();
            $arChildren[]=$item;
        }
        return $arChildren;
    }


}
