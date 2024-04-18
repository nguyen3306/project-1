<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarsModel extends Model
{
    protected $table = "cars";
    protected $fillable = ['id','name','brand','seat','status','date','img','cate_id','description','price'];
    use HasFactory;
}
