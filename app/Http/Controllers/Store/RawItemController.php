<?php

namespace App\Http\Controllers\Store;

use App\Http\Requests\RawItemCreateRequest;
use App\RawItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RawItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = RawItem::all();
        return view('store.items.index', ['items' => $items]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store.items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RawItemCreateRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RawItemCreateRequest $request)
    {
        $route = 'item.index';
        RawItem::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'unit' => $request->get('unit'),
            'stock' => $request->get('stock'),
        ]);
        if($request->has('add_and_create_new')) {
            $route = 'item.create';
        }
        return redirect()->route($route);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RawItem  $rawItem
     * @return \Illuminate\Http\Response
     */
    public function show(RawItem $rawItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RawItem  $rawItem
     * @return \Illuminate\Http\Response
     */
    public function edit(RawItem $rawItem)
    {
        echo "<pre>";
        echo "in edit ";
        print_r($rawItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RawItem  $rawItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RawItem $rawItem)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RawItem  $rawItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawItem $rawItem)
    {
        echo "<pre>";
        echo "in delete ";
        print_r($rawItem);
    }
}
