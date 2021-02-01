<?php

namespace App\Http\Controllers\Console\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hash;
use App\User;

class SaveUser extends Controller
{
    public function __invoke(Request $request)
    {
        $existing_user = User::where('email', $request->email)->first();
        if( $existing_user ){
            session()->flash('existing_email', true);
            return back()->withInput();
        }

        $user = new User([
            'name' => $request->name,
            'grade' => $request->grade,
            'section' => $request->section,
            'role' => 'student',
            'email' => $request->email,
            'password' => Hash::make("basamunauser")

        ]);

        $user->save();

        return redirect()->route('users.list');
    }
}
