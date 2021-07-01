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

        $arrayValues = explode(",", $request->value);
        if ($arrayValues) {
            foreach ($arrayValues as $valueItem) {
                if (!empty($valueItem)) {
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

        $categories = Category::orderBy('created_at', 'desc')->get();
        $properties = ProductProperty::orderBy('created_at', 'desc')->get();

        return view('admin.properties.edit', [
            'property' => $this->getPropertyArray($productProperty),
        ]);
    }

    public function edite($id)
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('admin.properties.edit', [
            'property' => $this->getPropertyArray(ProductProperty::find($id)),
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductProperty $productProperty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request/*, ProductProperty $productProperty*/)
    {
        $property = ProductProperty::find($request->id);
        $property->name = ucfirst($request->title);
        $property->save();

        $property->categories()->detach();
        $categories = Category::find($request->category_id);
        $property->categories()->attach($categories);

        $arrayValues = explode(",", $request->value);

        $valueList = [];

        foreach ($property->values->toArray() as $value) {
            $valueList[] = $value['id'];
        }

        foreach ($valueList as $key => $valueItem) {
            $value = PropertyValue::find($valueItem);
            if (!empty($arrayValues[$key])) {
                $value->value = $arrayValues[$key];
                $value->update();
            } else {
                $value->delete();
            }
        }

        return redirect()->route('properties.index')->withSuccess('Свойство было успешно изменено!');
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
        /* $productProperty->values()->delete();
        $productProperty->categories()->detach();
        $productProperty->delete();
        return redirect()->back()->withSuccess('Свойство было успешно удалено!');*/
    }

    public function delete($id)
    {
        $productProperty = ProductProperty::find($id);
        $productProperty->values()->delete();
        $productProperty->categories()->detach();
        $productProperty->delete();
        return redirect()->back()->withSuccess('Свойство было успешно удалено!');
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

        $arrayCategories = [];
        $categories = $property->categories->toArray();
        $arrayValues = $property->values->toArray();
        $property = $property->toArray();
        /* $property['updated_at'] = date('Y-m-d H:i:s', strtotime($property['updated_at']));
         $property['created_at'] = date('Y-m-d H:i:s', strtotime($property['created_at']));*/
        if (isset ($categories)) {
            foreach ($categories as $category) {
                $arrayCategories[] = $category['id'];
            }
        }
        $valueList = [];
        if (isset ($arrayValues)) {
            foreach ($arrayValues as $value) {
                $valueList[] = $value['value'];
            }
        }

        $property['categories'] = $arrayCategories;
        $property['values'] = $arrayValues;
        $property['valueList'] = implode(',', $valueList);

        return $property;
    }
}
