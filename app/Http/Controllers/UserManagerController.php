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
        $users = User::all();
        return view('user-manager.index', compact('users'));
    }
    public function makeAdmin(Request $request){
        $currentUser = User::find($request->id);
        if($currentUser->role != 0){
            $currentUser->role = '0';
            $currentUser->update();
            return redirect()->back()->with('toast',['icon'=>'success','title'=>'Changed to admin role']);
        }
    }

    public function banUser(Request $request){
        $currentUser = User::find($request->id);
        if($currentUser->isBaned == 0){
            $currentUser->isBaned = '1';
            $currentUser->update();
            return redirect()->back()->with('toast',['icon'=>'success','title'=>'Banned User']);
        }
    }

    public function unBanUser(Request $request){
        $currentUser = User::find($request->id);
        if($currentUser->isBaned == 1){
            $currentUser->isBaned = '0';
            $currentUser->update();
            return redirect()->back()->with('toast',['icon'=>'success','title'=>'Is not banned user']);
        }
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|String|min:8',
        ]);
        if($validator->fails()){
            return response()->json(["status"=>422,"message"=>$validator->errors()]);
        }
        $currentUser = User::find($request->id);
        if($currentUser->role != 0){
            $currentUser->password = Hash::make($request->password);
            $currentUser->update();
        }
        return response()->json(["status"=>200,"message"=>"Change password is complete for $currentUser->name"]);
    }
}
