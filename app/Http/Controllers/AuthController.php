<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('name');
    } 

    public function store(Request $request)
    {
        
        $this->validate($request, [
        	'name' => 'required',
        	'email' => 'required|email',
        	'password' => 'required|min:5',
        	'user_type' => 'required',
        	'address' => 'required',
        	'phone' => 'required'
        ]);
        
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $user_type = $request->input('user_type');
        $address = $request->input('address');
        $phone = $request->input('phone');

        $user = new \App\User([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'user_type' => $user_type,
            'address' => $address,
            'phone' => $phone
        ]);

        if ($user->save()) {
            $user->signin = [
                'href' => 'xyz/usercustomer/signin',
                'method' => 'POST',
                'params' => 'email, password'
            ];
            $response = [
                'msg' => 'User created',
                'user' => $user
            ];
            return response()->json($response, 201);                      
        }
        $response = [
            'msg' => 'An error occurred'
        ];

        return response()->json($response, 404);      
    }

    public function signin(Request $request)
    {
        $this->validate($request, [
        	'email' => 'required|email',
        	'password' => 'required'
        ]);
        


        $credentials = $request->only('email', 'password');

        try {
        	if (! $token = JWTAuth::attempt($credentials)) {
        		return response()->json(['msg' => 'Invalid credentials'], 401);
            }
            $email = $request->input('email');
            
            $query = "select users.user_type
                from users
            where
                users.email = " . "'" . $email . "'";
            
            $usertype = DB::select($query);

        } catch(JWTException $e) {
        	return response()->json(['msg' => 'Could not create token'], 500);
        }
        return response()->json(['token' => $token,
            'user_type' => $usertype
        ]);
    }
}
