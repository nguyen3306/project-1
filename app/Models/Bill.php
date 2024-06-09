<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "bills";
    protected $fillable = [	'id','user_id','car_id','rent_day','extra_hours','amount','voucher_id','voucher_value','order_id','code','created_at','updated_at'];
    use HasFactory;

}
