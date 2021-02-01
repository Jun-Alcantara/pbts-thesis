<?php

namespace App\Http\Controllers\Console\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewUserForm extends Controller
{
    public function __invoke()
    {
        $data['active_tab'] = "users";
        return view('console.users.new', $data);
    }
}
