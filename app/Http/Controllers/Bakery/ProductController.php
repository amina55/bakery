<?php

namespace App\Http\Controllers\Bakery;

use App\Category;
use App\Product;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $categoryID
     * @return \Illuminate\Http\Response
     */
    public function index($categoryID)
    {
        $products = Product::where('category_id', $categoryID)->with('unit')->get();
        $category = Category::find($categoryID);
        $units = Unit::all();
        return view('bakery.product.index', ['products' => $products, 'category' => $category, 'units' => $units]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoryID = $request->get('category_id');
        $update = [
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'unit_id' => $request->get('unit_id'),
        ];
        if($request->has('id')) {
            Product::where('id', $request->get('id'))->update($update);
        } else {
            $update['category_id'] = $categoryID;
            Product::create($update);
        }

        return redirect()->route('product.index', $categoryID);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $categoryID = $product->category_id;
        $product->delete();
        return redirect()->route('product.index', $categoryID);
    }
}
