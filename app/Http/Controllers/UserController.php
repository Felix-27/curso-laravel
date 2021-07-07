<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){
        $users = User::latest()->get();
        
        return view('Users.index', [
            'users' => $users
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password) //helper de laravel para encriptar password
        ]);

        return back();
    }   

    public function destroy(User $user){

        $user->delete();

        return back();
    }
}
