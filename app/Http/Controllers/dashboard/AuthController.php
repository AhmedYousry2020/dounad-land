<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;

class AuthController extends Controller
{
    //login form
    public function LoginForm(){

        return view("auth.login");
    }

    //login logic
    public function Login(Request $request){

        $validator = Validator::make($request->all(),[

            "email"=>"required|email",
            "password"=>"required",

        ]);

       if($validator->fails()){
        return redirect()->route('dashboard.loginForm')->withErrors($validator);

       }

       $requestAll = $validator->validated();

       $credentials = [
        "email"=>$requestAll['email'],
        "password"=>$requestAll['password']
       ];

       if(Auth::guard('staff')->attempt($credentials)){
        return redirect('/dashboard');

       }else{

        return redirect()->route('dashboard.loginForm')->with('error',"Unauthorized");
       }

    }

    //logout logic
    public function logout(){

        Auth::guard("admin")->logout();
        return redirect()->route('admin.loginForm');
    }

}
