<?php

namespace App\Http\Controllers\Console\User;

use App\Http\Controllers\Controller;

use App\User;

class UserList extends Controller
{
    public function __invoke()
    {
        $data['users'] = User::where('role', 'student')->get();
        $data['active_tab'] = "users";
        return view('console.users.list', $data);
    }
}
