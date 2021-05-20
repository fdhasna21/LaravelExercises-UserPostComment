<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed' //will automatically check with password_confirmation
        ]);
        //email_verified_at and remember_token should have better algorithm

        //If using insert database :
        // $name = $request->name;
        // $email = $request->email;
        // $password = Hash::make($request->password);
        // $data = array('name'=>$name,
        //             'email'=>$email,
        //             'password'=>$password,
        //             'created_at'=>now(),
        //             'updated_at'=>now(),
        //             'email_verified_at'=>now(),
        //             'remember_token'=>Str::random(10));
        // DB::table('users')->insert($data);


        //If save data using Model :
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email_verified_at= now();
        $user->remember_token= Str::random(10);
        $user->save();
        
        return response(['success'=> true], 200);
    }
}
