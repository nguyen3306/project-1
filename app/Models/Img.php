<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    protected $table = "car_images";
    protected $fillable = ['id','name','path','car_id'];
    use HasFactory;
}
