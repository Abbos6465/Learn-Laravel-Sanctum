<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthSessionController extends Controller
{
    public function login(Request $request){
        $login = $request->validate(['email'=>['required','email'],'password'=>['required']]);

        if(Auth::attempt($login)){
            $request->session()->regenerate();
            return response(['success']);
        }

        return response(['error']);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response(['logout']);
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => "required|email",
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        return response(['user'=>$user]);
    }
}
