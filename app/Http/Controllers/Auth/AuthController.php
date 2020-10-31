<?php

namespace App\Http\Controllers\Auth;

Use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

	public function login()
    {
    	if(Auth::check()){
    		return redirect()->route('sys.dashboard');
    	}

    	return view('auth.login');
    }

    public function authenticated(Request $request, User $user)
	{
		if($request->verificador === "IT**01"){
			if(Auth::attempt( ['email' => $request->email, 'password' => $request->password, 'active' => '1'] )){
				return redirect()->route('sys.dashboard');
			}
		}

		return redirect()->back()->withInput()->withErrors(['Informações não encontradas']);
	}
}
