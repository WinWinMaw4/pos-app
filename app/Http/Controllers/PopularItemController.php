<?php

namespace App\Http\Controllers;

use App\Models\PopularItem;
use App\Http\Requests\StorePopularItemRequest;
use App\Http\Requests\UpdatePopularItemRequest;

class PopularItemController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePopularItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePopularItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PopularItem  $popularItem
     * @return \Illuminate\Http\Response
     */
    public function show(PopularItem $popularItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PopularItem  $popularItem
     * @return \Illuminate\Http\Response
     */
    public function edit(PopularItem $popularItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePopularItemRequest  $request
     * @param  \App\Models\PopularItem  $popularItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePopularItemRequest $request, PopularItem $popularItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PopularItem  $popularItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PopularItem $popularItem)
    {
        //
    }
}
