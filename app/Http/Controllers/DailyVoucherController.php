<?php

namespace App\Http\Controllers;

use App\Models\DailyVoucher;
use App\Http\Requests\StoreDailyVoucherRequest;
use App\Http\Requests\UpdateDailyVoucherRequest;

class DailyVoucherController extends Controller
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
     * @param  \App\Http\Requests\StoreDailyVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDailyVoucherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DailyVoucher  $dailyVoucher
     * @return \Illuminate\Http\Response
     */
    public function show(DailyVoucher $dailyVoucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DailyVoucher  $dailyVoucher
     * @return \Illuminate\Http\Response
     */
    public function edit(DailyVoucher $dailyVoucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDailyVoucherRequest  $request
     * @param  \App\Models\DailyVoucher  $dailyVoucher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDailyVoucherRequest $request, DailyVoucher $dailyVoucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DailyVoucher  $dailyVoucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(DailyVoucher $dailyVoucher)
    {
        //
    }
}
