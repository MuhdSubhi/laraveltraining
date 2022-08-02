<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginapi(){

        $user = new User();

        $user = $user->where('email','=',request()->email)->first();

        // Log::debug('Request', [$password]);

        if($user && Hash::check( request()->password, $user->getAuthPassword())){
            return $user->createToken(time())->plainTextToken;
        }

        return 'Wrong Credentials';
    }

    public function logoutapi(){
        
        auth()->user()->currentAccessToken()->delete();

        return 'Your Are Logged Out';
    }
}
