<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;
    
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'user_id','branch_id','deliverer_id', 'otp', 'details','order_type', 'shop_name', 'shop_address', 'delivery_address', 'est_amount', 'act_amount', 'spl_instructions', 'status'
        ];
        
}
