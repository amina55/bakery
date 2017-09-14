<?php

namespace App\Http\Controllers\Store;

use App\Http\Requests\RawItemCreateRequest;
use App\RawItem;
use App\Unit;
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
        $items = RawItem::getRawItems();
        return view('store.items.index', ['items' => $items]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store.items.create', ['item' => null, 'units' => Unit::getActive()]);
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
            'unit_id' => $request->get('unit_id'),
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
        return view('store.items.create', ['item' => $rawItem, 'units' => Unit::getActive()]);
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
        $rawItem->description = $request->get('description');
        $rawItem->unit_id = $request->get('unit_id');
        $rawItem->save();
        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RawItem  $rawItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawItem $rawItem)
    {
        $rawItem->delete();
        return redirect()->back();
    }
}
