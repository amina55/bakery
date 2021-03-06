<?php

namespace App\Http\Controllers\Bakery;

use App\BakeryStock;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::getCategory();
        return view('bakery.category.index', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $update = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ];
        if($request->has('id')) {
            Category::where('id', $request->get('id'))->update($update);
        } else {
            Category::create($update);
        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Product::where('category_id', $category->id)->update(['status' => 0]);
        BakeryStock::where('category_id', $category->id)->update(['status' => 0]);
        $category->status = 0;
        return redirect()->route('category.index');
    }
}
