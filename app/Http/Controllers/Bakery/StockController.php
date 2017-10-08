<?php

namespace App\Http\Controllers\Bakery;

use App\BakeryStock;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock = BakeryStock::getStock();
        $products = Product::getProduct();
        $categories = Category::getCategory();

        return view('bakery.stock.index', ['stocks' => $stock, 'products' => $products, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);

        if ($request->has('id')) {
            BakeryStock::where('id', $request->get('id'))->update($inputs);
        } else {
            BakeryStock::create($inputs);
        }
        return redirect()->route('bakery_stock.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $bakeryStockId
     * @return \Illuminate\Http\Response
     */
    public function destroy($bakeryStockId)
    {
        BakeryStock::where('id', $bakeryStockId)->update(['status' => 0]);
        return redirect()->route('bakery_stock.index');
    }
}
