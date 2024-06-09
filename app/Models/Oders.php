<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oders extends Model
{
    protected $table = "orders";
    protected $fillable = [	'id','user_id','car_id','status','rent_day','extra_hours','voucher_id','voucher_value','payment_status','amount','code','created_at','updated_at'];
    use HasFactory;
}
