<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class FoodApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::latest('id')->with(['category'])->get();
//        return view("item.index",["items"=>$items]);
        return response()->json([
            'message'=>'Items',
            'data'=>$items
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $request->validate([
            //unique:table,column
            "name" => "required|unique:items,name|min:3|max:50",
            "category_id" => "required",
            "price"=>"required",
            "description"=>"nullable|max:100",
            "photo" => "required|max:5000"
        ]);
            $item = new Item();
            $item->name = ucwords($request->name);
            $item->category_id = $request->category_id;
            $item->price = $request->price;
            $item->description = $request->description;
            $item->photo = $request->photo;
            $item->save();

            return response()->json([
                'message'=>'item created',
                'data'=>$item
            ],201);

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
        $item = Item::with(['category'])->find($id);
        if(is_null($item)){
            return response()->json([
                'message'=>"No Contact With This ID",
                'status'=>404,
            ],404);
        }else{
            return response()->json([
                'data'=>$item,
            ],200);
        }

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

//        $validator = $request->validate([
//            //unique:table,column
//            "name" => "required|unique:items,name,".$id."|min:3|max:50",
//            "category_id" => "required",
//            "price"=>"required",
//            "description"=>"nullable|max:100",
//            "photo" => "required|max:5000"
//        ]);

        $item = Item::find($id);

        if($request->has('name')){
            $item->name = ucwords($request->name);
        }
        if($request->has('category_id')){
            $item->category_id = $request->category_id;
        }
        if($request->has('price')){
            $item->price = $request->price;
        }
        if($request->has('description')){
            $item->description = $request->description;
        }
        if($request->has('photo')){
            $item->photo = $request->photo;
        }

        $item->update();

        return response()->json([
            'message'=>'update success',
            'data'=>$item,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if(is_null($item)){
            return response()->json(["message"=>"No Contact With This ID","status"=>404],404);
        }

        if(Gate::denies('delete',$item)){
            return response()->json([
                "message"=>"forbidden",

            ],403);
        }

        $item->delete();
        return response()->json('delete success',204);

    }
}
