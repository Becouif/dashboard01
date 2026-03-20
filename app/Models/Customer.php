<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['user_id','first_name','last_name','email','phone','address','customer_since','total_spent'];
}
