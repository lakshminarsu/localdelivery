<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Drivers extends Model
{
	use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'curr_city', 'curr_pincode', 'is_onduty', 'is_available', 'amount', 'lat' ];    
}
