<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    public function changePassword(Request $request){
//        return $request;
        $validator=Validator::make($request->all(),[
            "newpassword" => "required|min:8"
        ]);
        if($validator->fails()){
            return response()->json(["status"=>422,"message"=>$validator->errors()]);
        }
        $currentUser=User::find($request->id);
        if($currentUser->role ==1 ){
            $currentUser->password = Hash::make($request->newpassword);
            $currentUser->update();
        }
        return response()->json(["status"=>200,"message"=>"Password Change for $currentUser->name complete"]);

    }
}

