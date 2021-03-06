<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Auth, Hash;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        if( isset( $request->password ) || isset($request->password_confirmation) ){
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed'
            ]);

            if( $validator->fails() ) return back()->withErrors($validator)->withInput();

            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->grade = $request->grade;
        $user->section = $request->section;
        $user->email = $request->email;

        $user->save();

        session()->flash('user_updated', true);

        return back();
    }
}
