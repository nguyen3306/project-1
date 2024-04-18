<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = RoleModel::all();
        $user = DB::table('users')->join('role', 'users.role_id', '=', 'role.id')->select('users.*', 'role.name as rolename')->get();
        // dd($user);

        return view("main.users.users", compact('role','user'));

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',

        ], [
            'email.required' => 'Tài khoản không tồn tại ',
            'email.email' => 'Sai định dạng email',
            'email.exists' => 'Email chưa đăng ký',

        ]);
        if ($validator->fails()) {
            return response()->json(['check' => false, 'msg' => $validator->errors()]);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            return response()->json(['check' => true]);
            
        } else {
            return response()->json(['check' => false, 'msg' => 'Sai email hoặc mật khẩu']);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'maGT' => $request->maGT,
            'address' => $request->address,
        ];
        User::create($data);
        return response()->json(['check' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,Request $request)
    {
        // dd($id);
        $role = RoleModel::all();
        $user = User::where('id', $id)->first();
        return view('main.users.update', compact('user','role'),);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
        $user1 = User::where('id', $id)->first();
        dd($user1);
        return view('main.users.users')->compact('user1');
        


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Request $request)
    {
        $Category = User::where('id', $request->id)->first();
        if (empty($Category)) {
            return response()->json(['check' => false]);
        }
        User::where('id', $request->id)->delete();
        return response()->json(['check' => true]);
    }
}
