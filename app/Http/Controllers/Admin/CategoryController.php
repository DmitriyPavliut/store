<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();

        return view('admin.category.index', [
            'categories' => $this->getCategoriesArray($categories)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('admin.category.create', [
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
        $new_category = new Category();
        $new_category->title = $request->title;
        $new_category->titleID = str_slug($request->title);
        $new_category->parent_id = $request->parent_id;
        $new_category->save();

        return redirect()->back()->withSuccess('Категория была успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::orderBy('created_at', 'desc')->get();

        return view('admin.category.edit', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->title = $request->title;
        $category->titleID = str_slug($request->title);
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->route('category.index')->withSuccess('Категория была успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (count($category->products) || count($category->child_category)) {
            return redirect()->back()->with('error', 'Ошибка удаления! Есть привязанные товары или подкатегории');
        } else {
            $category->properties()->detach();
            $category->delete();
            return redirect()->back()->withSuccess('Категория была успешно удалена!');
        }
    }

    private function getCategoriesArray($categories)
    {
        $arrayCategories = [];
        foreach ($categories as $categoryItem) {
            if ($categoryItem->parent_category['parent_id'] != null) {
                $categoryItem['parent_category'] = $categoryItem->parent_category->toArray();
            }
            $categoryItem = $categoryItem->toArray();
            $categoryItem['updated_at'] = date('Y-m-d H:i:s', strtotime($categoryItem['updated_at']));
            $categoryItem['created_at'] = date('Y-m-d H:i:s', strtotime($categoryItem['created_at']));
            $arrayCategories[] = $categoryItem;
        }
        return $arrayCategories;

    }

    private function getCategoryArray($categoryItem)
    {
        if ($categoryItem->parent_category['parent_id'] != null) {
            $categoryItem['parent_category'] = $categoryItem->parent_category->toArray();
        }
        $categoryItem = $categoryItem->toArray();
        $categoryItem['updated_at'] = date('Y-m-d H:i:s', strtotime($categoryItem['updated_at']));
        $categoryItem['created_at'] = date('Y-m-d H:i:s', strtotime($categoryItem['created_at']));

        return $categoryItem;
    }

}
