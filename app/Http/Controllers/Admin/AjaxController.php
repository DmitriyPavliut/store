<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AjaxController extends Controller
{

    public function index()
    {
        return $this->returnView('errors.404');
    }

    public function getProperties(Request $request)
    {
        $category = Category::find($request->categoryId);

        return $this->getPropertiesArray($category->properties);

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
