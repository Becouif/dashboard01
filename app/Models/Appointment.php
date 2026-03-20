<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['user_id','customer_id','services_id','appointment_date','start_time','duration_minutes','price','payment_status','notes'];

    public function customer()
    {
        
    }
}
