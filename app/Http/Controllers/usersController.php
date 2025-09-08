<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class usersController extends Controller
{
    public function index()
    {
        if(auth()->user()->role != "Admin")
        {
            return to_route('dashboard')->with('error', "Not allowed to access this page");
        }

        $users = User::where('role', '!=', "Admin")->get();

        return view('users.index',compact('users'));
    }

    public function store(request $request)
    {
        $check = User::where('name', $request->name)->orWhere('email', $request->email)->count();
        if($check > 0)
        {
            return back()->with('error', "User Already Exists");
        }

        User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]
        );

        return back()->with('success', "User Created");
    }

    public function changePassword(request $request, $id)
    {
        $user = User::find($id);
        $user->update(
           [
            'password' => Hash::make($request->password),
           ]
        );

        return back()->with('success', 'Password Changed');
    }
}
