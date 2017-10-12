<?php

namespace App\Http\Controllers;

use App\Block;
use \DB;
use App\Log as Log;
use Carbon\Carbon;
use App\BlockLength;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blocks = Block::with('length')->get();

        return view('block.index', compact('blocks'))->with('title', 'Blocks');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('block.create')->with('title', 'Create Block');
    }

    public function create_length($id){

        $block = Block::find($id);

        return view('block.create_length', compact('block'));
    }

    public function decreaseLength($length_id){
        $blockLength = BlockLength::find($length_id);

        $blockLength->stock = $blockLength->stock-1;

        if( $blockLength->stock-1 >= 0){
            $blockLength->save();
        }

        return response()->json(['stock' => $blockLength->stock, 'cubic' => round((1030/1000*1290/1000*($blockLength->length*$blockLength->stock)/ 1000),2)]);
    }

    public function increaseLength($length_id){
        $blockLength = BlockLength::find($length_id);

        $blockLength->stock = $blockLength->stock+1;
        $blockLength->save();

        return response()->json(['stock' => $blockLength->stock, 'cubic' => round((1030/1000*1290/1000*($blockLength->length*$blockLength->stock)/ 1000),2)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $block = new Block;

        $block->name = $request->input('name');
        $block->save();

        $user = \Auth::user()->name;
        $action = "Added a block";
        $details = "Block with name: " . $request->input('name');
        $date = Carbon::now()->toDateTimeString();

        $query = DB::table('logs')->insert(
            ['user' => $user, 'action' => $action, 'details' => $details, 'data_type' => "block", 'date' => $date]
        );

        return redirect()->action('BlockController@index');
    }

    public function store_length(Request $request)
    {
        $block = new BlockLength;

        $block->length = $request->input('length');
        $block->block_id = $request->input('block_id');
        $block->stock = $request->input('stock');
        $block->save();

        $user = \Auth::user()->name;
        $action = "Added a block length";
        $details = "Block length added " . $request->input('length') . " for block";
        $date = Carbon::now()->toDateTimeString();

        $query = DB::table('logs')->insert(
            ['user' => $user, 'action' => $action, 'details' => $details, 'data_type' => "block", 'date' => $date]
        );

        return redirect()->action('BlockController@index');
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
        $block = Block::findOrFail($id);

        return view('block.update', compact('block'));
    }

     public function edit_length($id)
    {
        $block = BlockLength::findOrFail($id);

        return view('block.update_length', compact('block'));
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
        $block = Block::findOrFail($id);

        $block->name = $request->input('name');
        $block->save();

        $user = \Auth::user()->name;
        $action = "Edited a block";
        $details = "Block with name: " . $block->name . ", changed to: " . $request->input('name');
        $date = Carbon::now()->toDateTimeString();

        $query = DB::table('logs')->insert(
            ['user' => $user, 'action' => $action, 'details' => $details, 'data_type' => "block", 'date' => $date]
        );

        return redirect()->action('BlockController@index');
    }

    public function update_length(Request $request, $id)
    {
        $block = BlockLength::findOrFail($id);

        $block->length = $request->input('length');
        $block->stock = $request->input('stock');
        $block->save();

        $user = \Auth::user()->name;
        $action = "Edited stock block length";
        $details = "Block length edited to: " . $request->input('length') . " - stock: " . $request->input('stock');
        $date = Carbon::now()->toDateTimeString();

        $query = DB::table('logs')->insert(
            ['user' => $user, 'action' => $action, 'details' => $details, 'data_type' => "block", 'date' => $date]
        );

        return redirect()->action('BlockController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $block = Block::find($id);
        $block->delete();

        $user = \Auth::user()->name;
        $action = "Block deleted";
        $details = "Block with name: " . $block->name . ", deleted.";
        $date = Carbon::now()->toDateTimeString();

        $query = DB::table('logs')->insert(
            ['user' => $user, 'action' => $action, 'details' => $details, 'data_type' => "block", 'date' => $date]
        );

        return redirect()->back();
    }

    public function destroy_length($id)
    {
        $blockL = BlockLength::find($id);
        $blockL->delete();

        $user = \Auth::user()->name;
        $action = "Stock length deleted";
        $details = "Block length deleted (" . $request->input('length') . " - stock: " . $request->input('stock') . ")";
        $date = Carbon::now()->toDateTimeString();

        $query = DB::table('logs')->insert(
            ['user' => $user, 'action' => $action, 'details' => $details, 'data_type' => "block", 'date' => $date]
        );

        return redirect()->back();
    }
}
