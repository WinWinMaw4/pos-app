<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\pos;
use App\Http\Requests\StoreposRequest;
use App\Http\Requests\UpdateposRequest;
use http\Env\Request;

class PosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(\Illuminate\Http\Request $request)
    {

//        $items = Category::find(8)->items;
//        dd($items);

        if($request->search){
            $items = Item::where('name','like','%'.$request->search.'%')
                ->orWhere('description','like','%'.$request->search.'%')
                ->latest()->paginate(10)->withQueryString();
        }elseif($request->category){
//            where("name","LIKE","%$request->category%")
            $items = Item::where("category_id","LIKE","%$request->category%")->paginate(5)->withQueryString();
        }else{
            $items = Item::latest()->paginate(20);
        }

        $categories = Category::all();
        return view('pos.index',[
            'items'=>$items,
            'categories'=>$categories,
            ]);
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
     * @param  \App\Http\Requests\StoreposRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreposRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function show(pos $pos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function edit(pos $pos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateposRequest  $request
     * @param  \App\Models\pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateposRequest $request, pos $pos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function destroy(pos $pos)
    {
        //
    }
}
