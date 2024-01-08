<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'min:3',],
            'username' => ['required', 'min:3', 'max:15', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        User::create([
            'name' => $request->name,
            'username' => Str::slug($request->username),
            'email' => $request->email,
            'password' => $request->password
        ]);

        //Auth user
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return redirect()->route('post.index', auth()->user()->username);
    }
}
