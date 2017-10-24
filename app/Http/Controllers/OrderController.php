<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use app\Order;
use JWTAuth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['only' => ['index', 'store', 'update', 'destroy', 'getBranchOrders', 'getdeliverers']]);
    }
    
    public function getBranchOrders() {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg' => 'user not found'], 404);
        }        

        $branch_id = Input::get('branch_id');
        $status = Input::get('status');

        if ($branch_id == -1) 
        {
            $query = "select orders.id,
            orders.branch_id,
            orders.otp,
            orders.details,
            orders.order_type,
            orders.shop_name,
            orders.shop_address,
            orders.delivery_address,
            orders.est_amount,
            orders.act_amount,
            orders.spl_instructions,
            orders.status,
            orders.created_at
                from orders
            where
                orders.status = " . $status;
        }
        else
        {
            $query = "select orders.id,
            orders.branch_id,
            orders.otp,
            orders.details,
            orders.order_type,
            orders.shop_name,
            orders.shop_address,
            orders.delivery_address,
            orders.est_amount,
            orders.act_amount,
            orders.spl_instructions,
            orders.status,
            orders.created_at
                from orders
            where
                orders.branch_id = " . $branch_id . " and status=". $status;
        }

    
        $orders = DB::select($query);
        
        $response = [
            'msg' => 'user orders',
            'orders' => $orders
        ];
        return response()->json($response, 200);                        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg' => 'user not found'], 404);
        }        
        
        $order_id = Input::get('order_id');
        $user_id = $user->id;
        if ($order_id == -1) {
            $query = "select orders.id,
            orders.otp,
            orders.deliverer_id,
            orders.details,
            orders.order_type,
            orders.shop_name,
            orders.shop_address,
            orders.delivery_address,
            orders.est_amount,
            orders.act_amount,
            orders.spl_instructions,
            orders.status,
            orders.created_at
        from orders
        where
            orders.user_id = " . $user_id;
            $deliverer = "";
        }
        else {
            $query = "select orders.id,
            orders.otp,
            orders.deliverer_id,
            orders.details,
            orders.	order_type,
            orders.	shop_name,
            orders.	shop_address,
            orders.	delivery_address,
            orders.est_amount,
            orders.act_amount,
            orders.spl_instructions,
            orders.status,
            orders.created_at
        from orders
        where
            orders.id = " . $order_id;
            
            $query2 = "select users.name, users.phone
            from users, orders where users.id = orders.deliverer_id and orders.id = " . $order_id;

            $deliverer = DB::select($query2);
        }


        $orders = DB::select($query);

        $response = [
            'msg' => 'user orders',
            'orders' => $orders,
            'deliverer' => $deliverer
        ];
        return response()->json($response, 200);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $this->validate($request, [
            'branch_id' => 'required',
            'deliverer_id' => 'required',
            'otp' => 'required',
            'details' => 'required',
            'shop_name' => 'required',
            'shop_address' => 'required',
            'delivery_address' => 'required',
            'amount' => 'required',
            'spl_instructions' => '',
            'status' => 'required'
        ]);

        $otp = $request->input('otp');
        $deliverer_id = $request->input('deliverer_id');
        $branch_id = $request->input('branch_id');
        $details = $request->input('details');
        $order_type = $request->input('order_type');
        $shop_name = $request->input('shop_name');
        $shop_address = $request->input('shop_address');
        $delivery_address = $request->input('delivery_address');
        $amount = $request->input('amount');
        $spl_instructions = $request->input('spl_instructions');
        $status = $request->input('status');

        $order = new \App\Order([
            'user_id' => $user->id,
            'branch_id' => $branch_id,
            'deliverer_id' => $deliverer_id,
            'otp' => $otp,
            'details' => $details,
            'order_type' => $order_type,
            'shop_name' => $shop_name,
            'shop_address' => $shop_address,
            'delivery_address' => $delivery_address,
            'est_amount' => $amount,
            'act_amount' => 0,
            'spl_instructions' => $spl_instructions,
            'status' => $status
        ]);

        if ($order->save()) {
            $order->order_details = [
                'href' => 'api/v1/xyz/order',
                'method' => 'POST',
                'params' => 'id, status'                
            ];
            $response = [
                'msg' => 'Order succesfully created',
                'user' => $order
            ];
            return response()->json($response, 201);             
        }
        $response = [
            'msg' => 'An error occurred'
        ];

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function getdelivererorders()
    {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg' => 'user not found'], 404);
        }
        
        //$deliverer_id = Input::get('deliverer_id');

        $query = "select orders.id,
            orders.otp,
            orders.details,
            orders.order_type,
            orders.shop_name,
            orders.shop_address,
            orders.delivery_address,
            orders.est_amount,
            orders.act_amount,
            orders.spl_instructions,
            orders.status,
            orders.created_at
        from orders
        where orders.status != 4 and orders.status != 0 and orders.deliverer_id = " . $user->id;
        
        $delivererorders = DB::select($query);
        
        $response = [
            'msg' => 'delivererorders',
            'orders' => $delivererorders
        ];
        
        return response()->json($response, 200);         
    }

    public function getdeliverers()
    {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg' => 'user not found'], 404);
        }
        
        $query = "select users.id,
            users.name
        from users
        where
            users.user_type = 9";

        $deliverers = DB::select($query);
            
        $response = [
            'msg' => 'deliverers',
            'deliverers' => $deliverers
        ];
        
        return response()->json($response, 200);               
    }    

    public function updateOrder(Request $request)
    {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg' => 'user not found'], 404);
        }
        
        $order_id = $request->input('order_id');
        $deliverer_id = $request->input('deliverer_id');
        $final_amt = $request->input('final_amt');
        $status = Input::get('status');
        $query = "update orders set status = " . $status . ",act_amount=" . $final_amt . ",deliverer_id=" . $deliverer_id . " where id = " . $order_id;
        $status = DB::update($query);

        $response = [
            'msg' => 'Cancel order',
            'status' => $status
        ];
        return response()->json($response, 200);        
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "delete Works123";
    }
}
