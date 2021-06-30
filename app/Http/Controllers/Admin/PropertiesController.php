<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductProperty;
use App\Models\PropertyValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        $properties = ProductProperty::orderBy('created_at', 'desc')->get();

        return view('admin.properties.index', [
            'categories' => $categories,
            'properties' => $this->getPropertiesArray($properties)
        ]);
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
        $new_property = new ProductProperty();
        $new_property->name = ucfirst($request->name);
        $new_property->save();

        $categories = Category::find($request->category_id);
        $new_property->categories()->attach($categories);

        $arrayValues=explode(",", $request->value);
        if ($arrayValues) {
            foreach ($arrayValues as $valueItem){
                if(!empty($valueItem)){
                    $value = new PropertyValue();
                    $value->value = $valueItem;
                    $new_property->values()->save($value);
                }
            }
        }

        return redirect()->back()->withSuccess('Свойство было успешно добавлено!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ProductProperty $productProperty
     * @return \Illuminate\Http\Response
     */
    public function show(ProductProperty $productProperty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ProductProperty $productProperty
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductProperty $productProperty)
    {
        dd($productProperty);

        return view('admin.properties.edit', [
            'property' => $this->getPropertyArray($productProperty),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductProperty $productProperty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductProperty $productProperty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ProductProperty $productProperty
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductProperty $productProperty)
    {
        dd($productProperty);
       /* $productProperty->delete();
        return redirect()->back()->withSuccess('Свойство было успешно удалено!');*/
    }

    private function getPropertiesArray($properties)
    {
        $arrayProperties = [];
        foreach ($properties as $property) {

            $arrayCategories = $property->categories->toArray();
            $arrayValues = $property->values->toArray();
            $property = $property->toArray();
            $property['updated_at'] = date('Y-m-d H:i:s', strtotime($property['updated_at']));
            $property['created_at'] = date('Y-m-d H:i:s', strtotime($property['created_at']));
            $property['categories'] = $arrayCategories;
            $property['values'] = $arrayValues;

            $arrayProperties[] = $property;
        }
        return $arrayProperties;
    }

    private function getPropertyArray($property)
    {
        dd($property);
        $arrayCategories = $property->categories->toArray();
        $arrayValues = $property->values->toArray();
        $property = $property->toArray();
        /* $property['updated_at'] = date('Y-m-d H:i:s', strtotime($property['updated_at']));
         $property['created_at'] = date('Y-m-d H:i:s', strtotime($property['created_at']));*/
        $property['categories'] = $arrayCategories;
        $property['values'] = $arrayValues;

        return $property;
    }
}
