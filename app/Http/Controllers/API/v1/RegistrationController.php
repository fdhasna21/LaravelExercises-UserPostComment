<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed' //will automatically check with password_confirmation
        ]);

        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);

        $data = array('name'=>$name,
                    'email'=>$email,
                    'password'=>$password,
                    'created_at'=>now(),
                    'updated_at'=>now(),
                    'email_verified_at'=>now(),
                    'remember_token'=>Str::random(10));
        //email_verified_at and remember_token should have better algorithm

        DB::table('users')->insert($data);
        return response(['success'=> true], 200);
    }
}
