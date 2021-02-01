<?php

namespace App\Http\Controllers\Console\User;

use App\Http\Controllers\Controller;

use App\User;

class Deleteuser extends Controller
{
    public function __invoke(User $user)
    {
        $user->delete();

        session()->flash('d', true);
        return back()->with('message', $user->name . " has been deleted.");
    }
}
