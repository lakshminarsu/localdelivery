<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User_customer;
use JWTAuth;

class UserCustController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['only' => ['store', 'update', 'destroy']]);
    }     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "It works!";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg' => 'user not found'], 404);
        }

        return response()->json([
            'msg' => 'user found',
            'userid' => $user->id
        ]);

        /*$this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'amount' => 'required'            
        ]);        

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $amount = $request->input('amount');

        $user = new \App\User_customer([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'address' => $address,
            'phone' => $phone,
            'amount' => $amount
        ]);

        if ($user->save()) {
            $user->signin = [
                'href' => 'api/v1/usercustomer/signin',
                'method' => 'POST',
                'params' => 'email, password'
            ];
            $response = [
                'msg' => 'User customer created',
                'user' => $user
            ];
            return response()->json($response, 201);                      
        }
        $response = [
            'msg' => 'An error occurred'
        ];*/

        return response()->json($response, 404);
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "It Works!";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return "It Works!";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "It Works!";
    }

    public function signin(Request $request)
    {
        return "It Works signin";
    }    
}
