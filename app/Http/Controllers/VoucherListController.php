<?php

namespace App\Http\Controllers;

use App\Models\VoucherList;
use App\Http\Requests\StoreVoucherListRequest;
use App\Http\Requests\UpdateVoucherListRequest;

class VoucherListController extends Controller
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
     * @param  \App\Http\Requests\StoreVoucherListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoucherListRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoucherList  $voucherList
     * @return \Illuminate\Http\Response
     */
    public function show(VoucherList $voucherList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoucherList  $voucherList
     * @return \Illuminate\Http\Response
     */
    public function edit(VoucherList $voucherList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoucherListRequest  $request
     * @param  \App\Models\VoucherList  $voucherList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoucherListRequest $request, VoucherList $voucherList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoucherList  $voucherList
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoucherList $voucherList)
    {
        //
    }
}
