<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware(['guest']);
    }

    public  function index() {
        return view ('auth.register');
    }



    public  function store(Request $request) {
       //validate
        $this->validate($request,[
            'name'=>'required',
            'username'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',

        ]);


       //store
        User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

       //sign in

        auth()->attempt($request->only('email','password'));

       //redirect

       return redirect()->route('dashboard');
    }
}
