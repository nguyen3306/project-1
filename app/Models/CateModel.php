<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateModel extends Model
{
    protected $table = "category";
    protected $fillable = ['id','name','status','created_at','updated_at'];
    use HasFactory;
}