<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function profileDetail(){
        return view('profile.info');
    }
    public function updateProfileImage(Request $request){

        $validation = Validator::make($request->all(),[
            "photo" => "nullable|file|mimes:jpeg,png|max:1000",
        ]);

        if($validation->fails()){
            return response()->json([
                "status" => 'fails',
                "errors"=>$validation->errors(),
            ]);
        }

        $user = User::find(auth()->id());

        if($request->hasFile('photo')){
            //            delete old cover
            Storage::delete("public/profile/".$user->photo);

            $newName = "profile_".uniqid().".".$request->file('photo')->extension();
            $request->file('photo')->storeAs("public/profile",$newName);
            $user->photo = $newName;

        }
        $user->update();


        return response()->json([
            "status" => 'success',
            "data"=>'Your form data updated',
        ]);
    }
    public function updateProfile(Request $request){
        $request->validate([
            "name" => "required|min:3|max:50",
            "photo" => "nullable|file|mimes:jpeg,png|max:1000",
            "email"=> "required|email|unique:users,email,".Auth::user()->id,
            "phone"=>"required",
            "gender"=> 'required|in:male,female',
            'address'=>'required|min:3|max:80'
        ]);

        $user = User::find(auth()->id());

        if($request->hasFile('photo')){
            //            delete old cover
            Storage::delete("public/profile/".$user->photo);

            $newName = "profile_".uniqid().".".$request->file('photo')->extension();
            $request->file('photo')->storeAs("public/profile",$newName);
            $user->photo = $newName;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->update();
//                return redirect()->to(url('user/profile/profile-detail/profile-info'));

        return redirect()->route('profileDetail')->with('status','profile update');

//
//        return response()->json([
//            "status" => 'success',
//            "data"=>'Your form data updated',
//        ]);

    }

    public function changePassword(){
        return view('profile.change-passwor');
    }

    public function updatePassword(Request $request){

        $request->validate([
            "old_password"=>"required|min:8",
            "password"=>"required|min:8",
            "password_confirmation"=>'required|min:8|same:password',

        ]);
        if(!Hash::check($request->old_password,auth()->user()->password)){
            return redirect()->to(url('user/profile/profile-detail/change-password'));

//            return redirect()->back()->withErrors(['old_password'=>"password don't match"]);
        }





        $user = User::find(auth()->id());
        $user->password = Hash::make($request->password);
        $user->update();
        auth()->logout();
        return redirect()->route('login');

//        return redirect()->to(url()->previous()."#idName");
//        return redirect()->route('changePassword');
        return $request;

    }
}
