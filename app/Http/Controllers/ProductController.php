<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($cat, $product_name, $product_id)
    {
        $item = Product::where('id', $product_id)->first();

        return $this->returnView('product.show', [
            'item' => $this->getProductsArray($item),
            'properties' =>$this->getPropertiesArray($item->category->properties),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    private function getProductsArray($product)
    {

        $arrayImages = $product->images->toArray();
        $properties = $product->properties->toArray();
        $arrayCategories = $product->category->toArray();
        $product = $product->toArray();
        $product['updated_at'] = date('Y-m-d H:i:s', strtotime($product['updated_at']));
        $product['created_at'] = date('Y-m-d H:i:s', strtotime($product['created_at']));
        $product['images'] = $arrayImages;
        $arrayProperties=[];
        if(count($properties)>0){
            foreach ($properties as $property){
                $arrayProperties[]=$property['id'];
            }
        }
        $product['category'] = $arrayCategories;
        $product['properties'] = $arrayProperties;

        return $product;
    }

    private function getPropertiesArray($properties)
    {
        $arrayProperties = [];
        foreach ($properties as $property) {
            if (isset($property->values)) {
                $arValue = $property->values->toArray();
                $arProperty = $property->toArray();
                $arProperty['values'] = $arValue;
                $arrayProperties[] = $arProperty;
            }

            else{
                $arProperty = $property->toArray();
                $arProperty['values'] = [];
                $arrayProperties[] = $arProperty;
            }
        }
        return $arrayProperties;
    }


}
