<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User_driver;
use Illuminate\Support\Facades\DB;
use App\Drivers;

class UserDriverController extends Controller
{
    public function __construct()
    {
        // $this->middleware('name');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "It works index!";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teststr = "34.6789";
        $values = explode(".", $teststr);
        echo $values[0];
       /* $response = \GeometryLibrary\SphericalUtil::computeDistanceBetween(
              ['lat' => 13.0728316, 'lng' => 77.5907761], //from array [lat, lng]
              ['lat' => 13.0701784, 'lng' => 77.5991375]); // to array [lat, lng]
              
        return $response; // 444891.52998049        
        */
        //return "user driver testing!";
        /*$this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'id_no' => 'required',
            'id_type' => 'required',
            'curr_city' => 'required',
            'curr_pincode' => 'required',
            'is_onduty' => 'required',
            'is_available' => 'required',
            'amount' => 'required',
            'lat' => 'required',
            'long' => 'required'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $id_no = $request->input('id_no');
        $id_type = $request->input('id_type');
        $curr_city = $request->input('curr_city');
        $curr_pincode = $request->input('curr_pincode');
        $is_onduty = $request->input('is_onduty');
        $is_available = $request->input('is_available');
        $amount = $request->input('amount');
        $lat = $request->input('lat');
        $long = $request->input('long');

        $user_driver = new \App\User_driver([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'address' => $address,
            'phone' => $phone,
            'id_no' => $id_no,
            'id_type' => $id_type,
            'curr_city' => $curr_city,
            'curr_pincode' => $curr_pincode,
            'is_onduty' => $is_onduty,
            'is_available' => $is_available,
            'amount' => $amount,
            'lat' => $lat,
            'long' => $long
        ]);

        if ($user_driver->save()) {
            $user_driver->signin = [
                'href' => 'api/v1/drivercustomer/signin',
                'method' => 'POST',
                'params' => 'email, password'                
            ];
            $response = [
                'msg' => 'User driver created',
                'user' => $user_driver
            ];
            return response()->json($response, 201);             
        }
        $response = [
            'msg' => 'An error occurred'
        ];

        return response()->json($response, 404);   */     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "This is show";
    }

    public function getDrivers()
    {
        $pincode = Input::get('pincode');
   
        $pincode = "'" + $pincode + "'";
        $query = "select drivers.id,
                   drivers.user_id,
                   drivers.lat,
                   drivers.long
                   from drivers
            where
                    drivers.curr_pincode = " . $pincode;
        //return $query;
        /*$drivers = DB::table('drivers')
                        ->where('curr_pincode', $pincode)->get();*/
        $drivers = DB::select($query);
        
        //return $drivers;
        /*$driver->view_drivers = [
            'href' => 'api/v1/drivers',
            'method' => 'GET'
        ];*/

        $response = [
            'msg' => 'Near by drivers',
            'drivers' => $drivers
        ];
        return response()->json($response, 200);
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
        return "It works!";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "It works!";
    }
}
