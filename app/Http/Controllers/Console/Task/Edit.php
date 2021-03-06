<?php

namespace App\Http\Controllers\Console\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;

class Edit extends Controller
{
    public function __invoke()
    {
        $data['active_tab'] = 'task';
        $data['tasks'] = Task::first();

        return view('console.task.edit', $data);
    }
}
