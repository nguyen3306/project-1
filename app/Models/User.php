<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function index()
    {
        $role = RoleModel::all();
        $user = DB::table('users')->join('role', 'users.idRole', '=', 'role.id')->select('users.*', 'role.name as rolename')->get();
        // dd($user);
        return view("main.user", compact("role", "user"));
    }
    /**
     * The attributes that are mass assignable.
     *
     * 
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'role_id',
        'email',
        'password',
        'phone',
        'address',
        'SL_ma_duoc_GT',
        'ma_GT',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
