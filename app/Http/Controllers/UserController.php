<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function login(){
        return view('auth.login');
    }
    
    function loginattempt () {

        $IsAuth = auth()->attempt([

            'email'=> request()->email,
            'password'=>request()->password,

        ]);

        // Log::debug("message",['what happen here']);
        
        if($IsAuth){
            return redirect()->route('view.selamatdatang');
        }else{
            return redirect()->route('errors.unauthorized');
        }
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('view.home');
    }
}
