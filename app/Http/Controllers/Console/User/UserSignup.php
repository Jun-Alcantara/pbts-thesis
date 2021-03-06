<?php

namespace App\Http\Controllers\Console\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Hash, Auth;

use App\User;

class UserSignup extends Controller
{
    public function form()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users'
        ]);

        if( $validator->fails() ){
            return back()->withInput()->withErrors($validator);
        }

        $user = User::create([
            'name' => $request->name,
            'grade' => $request->grade,
            'section' => $request->section,
            'role' => 'student',
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::attempt(['email' => $user->email, 'password' => $request->password]);

        return redirect()->route('dashboard');
    }
}