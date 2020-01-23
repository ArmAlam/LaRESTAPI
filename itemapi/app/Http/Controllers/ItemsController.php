<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required'
        ]);

        if ($validator->fails()) {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        } else {
            // Create a New Item
            $item = new Item;
            $item->text = $request->text;
            $item->body = $request->body;

            $item->save();
            return response()->json($item);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        return response()->json($item);
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
        $validator = Validator::make($request->all(), [
            'text' => 'required'
        ]);

        if ($validator->fails()) {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        } else {
            // Find an Item
            $item = Item::find($id);
            $item->text = $request->text;
            $item->body = $request->body;

            $item->save();
            return response()->json($item);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find an Item
        $item = Item::find($id);
        $item->delete();

        $response = array('response' => 'Item Deleted', 'success' => true);
        return $response;
    }
}
