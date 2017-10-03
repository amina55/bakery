<?php

namespace App\Http\Controllers\Kitchen;

use App\BakeryRequest;
use App\BakeryStock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listBakeryRequests()
    {
        $requests = BakeryRequest::getRequests();
        $stocks = BakeryStock::getStock();
        return view('kitchen.bakery_request.index', ['requests' => $requests, 'stocks' => $stocks]);
    }


    public function approveBakeryRequest(Request $request)
    {
        $inputs = $request->all();
        BakeryRequest::where('id', $inputs['id'])
            ->update(['status' => 'approved',
                'deliver_date' => date('Y-m-d'),
                'approve_quantity' => $inputs['approve_quantity']]);

        return redirect()->route('bakery_req.list');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
