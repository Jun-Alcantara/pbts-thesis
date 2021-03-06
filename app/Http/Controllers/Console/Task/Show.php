<?php

namespace App\Http\Controllers\Console\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;

class Show extends Controller
{
    public function __invoke()
    {
        $data['tasks'] = Task::first();

        return view('task', $data);
    }
}
