<?php

namespace App\Http\Controllers\Store;

use App\Http\Requests\SupplierCreateRequest;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('store.supplier.index', ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store.supplier.create', ['supplier' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SupplierCreateRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierCreateRequest $request)
    {
        $route = 'supplier.index';
        Supplier::updateOrCreate(
            ['identifier' => $request->get('identifier', $request->get('unique_identifier'))], [
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'phone_no' => $request->get('phone_no'),
        ]);
        if($request->has('add_and_create_new')) {
            $route = 'supplier.create';
        }
        return redirect()->route($route);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('store.supplier.create', ['supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
