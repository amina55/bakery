<?php

namespace App\Http\Controllers\Bakery;

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
    public function index()
    {
        $requests = BakeryRequest::getRequests();
        $stocks = BakeryStock::getStock();
        return view('bakery.request.index', ['requests' => $requests, 'stocks' => $stocks]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);

        $inputs['demand_date'] = date('Y-m-d', strtotime($inputs['demand_date']));

        if ($request->has('id')) {
            BakeryRequest::where('id', $request->get('id'))->update($inputs);
        } else {
            BakeryRequest::create($inputs);
        }
        return redirect()->route('bakery_request.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BakeryRequest  $bakeryRequest
     * @return \Illuminate\Http\Response
     */
    public function show(BakeryRequest $bakeryRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BakeryRequest  $bakeryRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(BakeryRequest $bakeryRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BakeryRequest  $bakeryRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BakeryRequest $bakeryRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BakeryRequest  $bakeryRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(BakeryRequest $bakeryRequest)
    {
        $bakeryRequest->delete();
        return redirect()->route('bakery_request.index');
    }
}
