<?php

namespace App\Http\Controllers\Kitchen;

use App\BakeryStock;
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
        $stocks = BakeryStock::getStock();
        $products = Product::getProduct();
        return view('kitchen.stock.index', ['stocks' => $stocks, 'products' => $products]);
    }


    public function addQuantity(Request $request)
    {
        BakeryStock::where('id', $request->get('id'))
            ->increment('kitchen_quantity', $request->get('kitchen_quantity', 0));

        return redirect()->route('kitchen_stock.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BakeryStock  $bakeryStock
     * @return \Illuminate\Http\Response
     */
    public function show(BakeryStock $bakeryStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BakeryStock  $bakeryStock
     * @return \Illuminate\Http\Response
     */
    public function edit(BakeryStock $bakeryStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BakeryStock  $bakeryStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BakeryStock $bakeryStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BakeryStock  $bakeryStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(BakeryStock $bakeryStock)
    {
        //
    }
}
