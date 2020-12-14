<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UsersController extends Controller
{
    public function index()
    {
        return view('users.index')->with('users', User::all());
    }
    public function update(User $user)
    {
        return view('users.update', ['user' => $user]);
    }

    public function create()
    {
        // return redirect(route('users.create'));
        return view('users.create');
    }

    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();
        return redirect(route('users.index'));
    }
    public function makeWriter(User $user)
    {
        $user->role = 'writer';
        $user->save();
        return redirect(route('users.index'));
    }
    public function store(Request $request)
    {
        // $password = Hash::make();
        $image = $request->image->store('images', 'public');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'image' => $image
        ]);

        // return view('users.create');
        return redirect(route('users.index', ['image' => $image]));
    }
    // public function getimage(){}
}
