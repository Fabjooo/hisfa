<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\StockType;
use App\Stock;
use DB;
use App\Log as Log;
use Carbon\Carbon;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkIfLoggedIn(){
        if(\Auth::user()){
            return true;
        }else{
            return false;
        }
    }
    public function index()
    {
        if($this->checkIfLoggedIn()){

            // account type achterhalen + optie's
            $loggedInUser = \Auth::user()->id;

            // opties ophalen voor de ingelogde user
            $account_options = DB::table('user_permissions')->where('user_id', '=', $loggedInUser)->pluck('options');

            // de id van ingelogde user ophalen uit user_permissions
            $account_id = DB::table('user_permissions')->where('user_id', '=', $loggedInUser)->pluck('user_id');

            $stockTypes = StockType::all();

            return view('stock.index', compact('stockTypes', 'account_options', 'account_id'))
                   ->with('title', 'Resources');

        }else{
            return redirect('login');
        }
    }

    public function increase($id){
        if($this->checkIfLoggedIn()){
            $stock = Stock::findOrFail($id);
            $stock->increment('tonnage');
            $stock->save();

            return redirect()->back();
        }else{
            return redirect('login');
        }

    }

    public function decrease($id){
        if($this->checkIfLoggedIn()){
            $stock = Stock::findOrFail($id);
            $stock->decrement('tonnage');
            $stock->save();

            return redirect()->back();
        }else{
            return redirect('login');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->checkIfLoggedIn()){
            // account type achterhalen + optie's
            $loggedInUser = \Auth::user()->id;

            // opties ophalen voor de ingelogde user
            $account_options = DB::table('user_permissions')->where('user_id', '=', $loggedInUser)->pluck('options');

            // de id van ingelogde user ophalen uit user_permissions
            $account_id = DB::table('user_permissions')->where('user_id', '=', $loggedInUser)->pluck('user_id');
            return view('stock.create', compact('account_options', 'account_id'))
                   ->with('title', 'Add a raw material');
        }else{
            return redirect('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stock = Stock::create([
            'tonnage' => $request->input('tonnage'),
            'image' => '',
        ]);

        $stockType = StockType::create([
            'type' => $request->input('type'),
            'stock_id' => $stock->id
        ]);

        $user = \Auth::user()->name;
		$action = "Added a block";
		$details = $request->input('type') . " added";
		$dataType = "stock";
		$date = Carbon::now()->toDateTimeString();

		$query = DB::table('logs')->insert(
			['user' => $user, 'action' => $action, 'details' => $details, 'data_type' => $dataType, 'date' => $date]
		);

        return redirect()->action('StockController@index');
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
        if($this->checkifLoggedIn()){

            // account type achterhalen + optie's
            $loggedInUser = \Auth::user()->id;

            // opties ophalen voor de ingelogde user
            $account_options = DB::table('user_permissions')->where('user_id', '=', $loggedInUser)->pluck('options');

            // de id van ingelogde user ophalen uit user_permissions
            $account_id = DB::table('user_permissions')->where('user_id', '=', $loggedInUser)->pluck('user_id');
            $stock = StockType::with('stock')->findOrFail($id);

            return view('stock.create', compact('stock', 'account_options', 'account_id'))
                   ->with('title', 'Update material');
        }else{
            return redirect('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_StockAvatar(Request $request){
        try {
            //handle userupload of avatar
            if($request->hasFile('image')){
                $StockAvatar = $request->file('image');
                $filename= time() . '.' .$StockAvatar->getClientOriginalExtension();
                $path = public_path('img/' . $filename);
                Image::make($StockAvatar->getRealPath())->resize(300, 300)->save($path);
                //Image::make($StockAvatar)->resize(300,300)->save(public_path('/img/' . $filename));
                $user = Auth::user();
                $user->avatar = $filename;
                $user->save();

            }
            // return view('profile', array('user' => Auth::user()));
            return redirect('stock'); //->with('feedback', 'Stock/Resource-photo succesfully changed.');
        } catch(\Exception $e) {
            \Session::flash('flash_error', $e);
            return redirect('settings/profile');
        }

    }

    public function update(Request $request, $id)
    {
        $stockType = StockType::findOrFail($id);
        $stock = Stock::findOrFail($stockType->stock_id);

        $stockType->type = $request->input('type');
        $stock->tonnage = $request->input('tonnage');

        $stockType->save();
        $stock->save();

        $user = \Auth::user()->name;
		$action = "Updated a block";
		$details = $request->input('type') . " tonnage: " . $request->input('tonnage');
		$dataType = "stock";
		$date = Carbon::now()->toDateTimeString();

		$query = DB::table('logs')->insert(
			['user' => $user, 'action' => $action, 'details' => $details, 'data_type' => $dataType, 'date' => $date]
		);

        return redirect()->action('StockController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->checkIfloggedIn()){

            $stockType = StockType::findOrFail($id);
            $stock = Stock::findOrFail($stockType->stock_id);

            $stockType->delete();
            $stock->delete();

            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function addAvatar($id)
    {
        if(Input::file())
        {
            $image = Input::file('image');
        }
    }
}
