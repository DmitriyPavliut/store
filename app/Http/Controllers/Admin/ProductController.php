<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\PropertyValue;
use Illuminate\Database\Eloquent\Model;
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
        $products = Product::orderBy('created_at', 'desc')->get();

        return view('admin.product.index', [
            'products' => $this->getProductsArray($products)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();

        return view('admin.product.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $propertyArray = [];
        foreach ($request->toArray() as $key => $values) {
            if (strpos($key, 'property_') === 0) {
                foreach ($values as $value)
                    $propertyArray[] = $value;
            }
        }

        $product = new Product();
        $product->title = $request->title;
        $product->titleID = str_slug($request->title);
        $product->category_id = $request->cat_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = $request->active;
        $product->save();

        if ($request->img) {
            $image = new ProductImage();
            $image->img = $request->img;
            $product->images()->save($image);
        }

        $properties = PropertyValue::find($propertyArray);
        $product->properties()->attach($properties);

        return redirect()->back()->withSuccess('Товар была успешно добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();



        return view('admin.product.edit', [
            'categories' => $categories,
            'product' => $this->getProductArray($product),
            'properties'=>$this->getPropertiesArray($product->category->properties),
        ]);
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
        $propertyArray = [];
        foreach ($request->toArray() as $key => $values) {
            if (strpos($key, 'property_') === 0) {
                foreach ($values as $value)
                $propertyArray[] = $value;
            }
        }

        $product->title = $request->title;
        $product->titleID = str_slug($request->title);
        $product->category_id = $request->cat_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = $request->active;
        $product->save();

        $product->images()->update(['img' => $request->img]);

        $properties = PropertyValue::find($propertyArray);
        $product->properties()->attach($properties);

        return redirect()->route('product.index')->withSuccess('Товар была успешно добавлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->properties()->detach();
        $product->delete();
        return redirect()->back()->withSuccess('Товар был успешно удален!');
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
            $product['category'] = $arrayCategories;

            $arrayProducts[] = $product;
        }
        return $arrayProducts;

    }

    private function getProductArray($products)
    {
        $arrayImages = $products->images->toArray();
        $arrayCategories = $products->category->toArray();
        $arrayProperties = $products->properties->toArray();

        $propertyArray = [];
        foreach ($arrayProperties as $value) {
                $propertyArray[] = $value['id'];
        }

        $products = $products->toArray();
        $products['updated_at'] = date('Y-m-d H:i:s', strtotime($products['updated_at']));
        $products['created_at'] = date('Y-m-d H:i:s', strtotime($products['created_at']));
        $products['images'] = $arrayImages;
        $products['category'] = $arrayCategories;
        $products['properties'] = $propertyArray;

        return  $products;
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
