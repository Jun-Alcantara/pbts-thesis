<?php

namespace App\Http\Controllers\Console\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

class UpdateUser extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        if( $user->email != $request->email ){
            $existing_email = User::where('email', $request->email)->first();
            if ($existing_email) {
                session()->flash('existing_email', true);
                return back()->withInput();
            }else{
                $user->email = $request->email;
            }
        }

        $user->name = $request->name;
        $user->grade = $request->grade;
        $user->section = $request->section;

        $user->save();

        session()->flash('success', 'User details updated.');
        return back();
    }
}
