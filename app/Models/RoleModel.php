<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table = "role";
    protected $fillable = ['id','name','created_at','updated_at'];
    use HasFactory;
}
