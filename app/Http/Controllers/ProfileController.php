<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        return view('user-profile.profile');
    }
    public function upload(){
        return view('user-profile.update-photo');
    }
    public function changeNameEmail(){
        return view('user-profile.update-name-email');
    }
    public function changePasswordShow(){
        return view('user-profile.change-password');
    }
    public function changePhoto(Request $request){
        $request->validate([
            "photo"=>"required|mimes:jpeg,png,jpg|file|max:2500"
        ]);
        $dir = "public/profile/";
        Storage::delete($dir.Auth::user()->photo);
        $file = $request->file('photo');

        $newName = uniqid()."_profile.".$file->getClientOriginalExtension();
        $file->storeAs($dir,$newName);

        $user = User::find(Auth::id());
        $user->photo = $newName;
        $user->update();
        return redirect()->back()->with("toast",["icon"=>"success", "title"=>"Photo Updated"]);
    }
    public function changeName(Request $request){
        $request->validate([
           "name"=>"required|min:3|max:50"
        ]);
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->update();
        return redirect()->route('profile.update-nameEmail')->with("toast",["icon"=>"success", "title"=>"Your name is Updated"]);
    }
    public function changeEmail(Request $request){
        $request->validate([
            "email"=>"required|min:3|max:50"
        ]);
        $user = User::find(Auth::id());
        $user->email = $request->email;
        $user->update();
        return redirect()->route('profile.update-nameEmail')->with("toast",["icon"=>"success", "title"=>"Email Updated"]);
    }
    public function changePassword(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword()],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->update();
        Auth::logout();
        return redirect()->route('login')->with("toast",["icon"=>"success", "title"=>"Password Updated"]);
    }
    public function updateInfo(Request $request){
        $request->validate([
            "phone"=>"required|max:12",
            "address"=>"required"
        ]);

        $user = User::find(Auth::id());
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return redirect()->back()->with("toast",["icon"=>"success", "title"=>"Info Updated"]);

    }
}
