<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    protected $request;

	public function __construct()
	{
        
	}
	
    public function index(Request $request)
    {

    	if(Auth::check()){
    		$active = 'home';
    		return view('sys.dashboard.index', compact('active'));
    	}

    	return redirect()->route('login');
    }
}
