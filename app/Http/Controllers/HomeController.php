<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Silo;
use App\SiloType;
use App\User;
use App\Block;
use App\UserPermissions;
use DB;
use Illuminate\Contracts\Auth\Authenticatable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // account type achterhalen + optie's
        $loggedInUser = \Auth::user()->id;

        // opties ophalen voor de ingelogde user
        $account_options = DB::table('user_permissions')->where('user_id', '=', $loggedInUser)->pluck('options');

        // de id van ingelogde user ophalen uit user_permissions
        $account_id = DB::table('user_permissions')->where('user_id', '=', $loggedInUser)->pluck('user_id');

        $waste_silos = SiloType::with('silo')->where('type','=','waste')->get();
        $prime_silos = SiloType::with('silo')->where('type','=','prime')->get();

        $silo_contents_waste =  DB::table('silo_contents')
                                ->join('silo_types', 'silo_contents.silo_id', '=', 'silo_types.silo_id')
                                ->where('silo_types.type', '=', 'waste')
                                ->get();

        $silo_contents_prime =  DB::table('silo_contents')
                                ->join('silo_types', 'silo_contents.silo_id', '=', 'silo_types.silo_id')
                                ->where('silo_types.type', '=', 'prime')
                                ->get();

    	$silos = DB::table('silos')
            ->join('silo_types', 'silos.id', '=', 'silo_types.silo_id')
            ->select('silos.*', 'silo_types.type')
			->where('silos.volume', '>=', '90')
            ->get();

        $blocks = Block::with('length')->get();

        $logs = DB::table('logs')->orderBy('date', 'desc')->take(5)->get();

        return view('home', compact('account_id', 'blocks', 'account_options', 'account_type', 'prime_silos', 'waste_silos', 'silos', 'logs', 'silo_contents_waste', 'silo_contents_prime'));

    }
}
