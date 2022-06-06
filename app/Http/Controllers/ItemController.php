<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::latest('id')->paginate(7);
        return view("item.index",["items"=>$items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        $request->validate([
            //unique:table,column
            "name" => "required|unique:items,name|min:3|max:50",
            "category_id" => "required",
            "price"=>"required",
            "description"=>"nullable|max:100",
            "photo" => "required|file|mimes:jpeg,png|max:5000"
        ]);

        //photo Save in local
        $newName = "item_".uniqid().".".$request->file('photo')->extension();
        $request->file('photo')->storeAs("public/item",$newName);

        $item = new Item();
        $item->name = ucwords($request->name);
        $item->category_id = $request->category_id;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->photo = $newName;
        $item->save();

        return redirect()->back()->with('status',"Added Item Success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('item.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $request->validate([
//            .$this->route('post')->id.
            "name" => "required|unique:items,name,".$item->id."|min:3|max:50",
            "category_id" => "required",
            "price"=>"required",
            "description"=>"nullable|max:100",
            "photo" => "nullable|file|mimes:jpeg,png|max:5000"
        ]);
//        return $request;

        $item->name = ucwords($request->name);
        $item->category_id = $request->category_id;
        $item->price = $request->price;
        $item->description = $request->description;
        if($request->hasFile('photo')){
            //            delete old cover
            Storage::delete("public/item/".$item->photo);

            $newName = "item_".uniqid().".".$request->file('photo')->extension();
            $request->file('photo')->storeAs("public/item",$newName);
            $item->photo = $newName;
        }

        $item->update();

//        return redirect()->to(url()->previous()."#nav-list");

        return redirect()->route('item.index')->with('status','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        Storage::delete('public/item/'.$item->photo);

        $item->delete();
        return redirect()->route('item.index')->with('status',"Deleted successful");
    }
}
