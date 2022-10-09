<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagerController extends Controller
{
    public function index(){
        $users=Auth::user()->all();
        return view('user-manager.index',compact('users'));
    }
    public function makeAdmin(Request $request){
//        return $request;
        $user=User::find($request->id);
        if($user->role == "1"){
            $user->role="0";
            $user->update();
        }
        return redirect()->back()->with("toast",["icon"=>"success","title"=>"Role updated for ".$user->name]);
    }
    public function baned(Request $request){
        $user=User::find($request->id);
        if($user->isBaned == "0"){
            $user->isBaned="1";
            $user->update();
        }
        return redirect()->back()->with("toast",["icon"=>"success","title"=>"Baned to ".$user->name]);
    }
}

