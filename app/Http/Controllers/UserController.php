<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function checkUser(Request $request){
        //$userData = User::find(2)->where('name','=',$request->name)->where('password','=',$request->password);
        $user= User::where('name', $request->name)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['status'=>400]);
        }
        $request->session()->put('user_exist','yes');
        return response(['status'=>200]);
        // //if($userData){
        //     if(Auth::attempt(['name'=>$request->name,'password'=>$request->password,'email'=>'bhitai@gmail.com']))
        //     {
        //         $request->session()->put('user_exist','yes');
        //         return response(['status'=>200]);            

        //     }
        // //} 
        //  return response(['status'=>400]);
        

    }
}
