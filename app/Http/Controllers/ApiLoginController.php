<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Concour;

use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{
    //
    public function login(Request $req){
        $req->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $user = User::where('email',$req->post('email'))->first();
        
        if($user){
            if(Hash::check($req->password,$user->password)){
                return response(['user'=>$user,'token'=>$user->createToken('resultiiappetino4')->plainTextToken],200);
            }else {
                return response(['error'=>'No user found'],400);
            }
            
        }else {
            return response(['error'=>'No user found'],400);
        }

        
    }

    public function register(Request $req){
        $req->validate([
            'name' => ['required','string'],
            'password' => ['required','string','confirmed'],
            'email' => ['string','unique:users'],
        ]);
        
        $req['password'] = Hash::make($req['password']);
        return User::create($req->all());
    }

    public function logout(Request $req){
        $req->user()->currentAccessToken()->delete();
        return response("Successfully logout",200);
    }

    public function detailedresults($name){
        $concour = Concour::where('name',$name)->first();
        if($concour){
            return response($concour->concourImage());
        }else{
            return response('Not Found');
        }
    }
}
