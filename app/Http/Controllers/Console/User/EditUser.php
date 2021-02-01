<?php

namespace App\Http\Controllers\Console\User;

use App\Http\Controllers\Controller;

use App\User;

class EditUser extends Controller
{
    public function __invoke(User $user)
    {
        $data['user'] = $user;
        $data['active_tab'] = "users";
        return view('console.users.edit', $data);
    }
}
