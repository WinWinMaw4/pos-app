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
//            $items = Category::with('items')->where('name',$request->search)->latest()->paginate(10)->withQueryString();
//            return $items;

            $items = Item::where('name','like','%'.$request->search.'%')
                ->orWhere('description','like','%'.$request->search.'%')->with('category')
                ->latest()->paginate(10)->withQueryString();
            $categorySearch = Category::where('name','like','%'.$request->search.'%')->with('items')->get();


        }elseif($request->category){
            $items = Item::where("category_id","LIKE","%$request->category%")->paginate(5)->withQueryString();
            $categorySearch = null;
//            $items = Category::with('items')->where('name',$request->category)->latest()->paginate(10)->withQueryString();
//            return $items;
        }else{
            $items = Item::latest()->paginate(20);
            $categorySearch = null;

        }

        $categories = Category::all();
        return view('pos.index',[
            'items'=>$items,
            'categories'=>$categories,
            'categorySearch'=>$categorySearch,
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
