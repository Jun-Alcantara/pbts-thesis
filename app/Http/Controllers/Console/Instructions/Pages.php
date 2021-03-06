<?php

namespace App\Http\Controllers\Console\Instructions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Pages extends Controller
{
    public function __invoke()
    {
        $data['active_tab'] = "instructions";
        return view('console.instructions.pages', $data);
    }
}
