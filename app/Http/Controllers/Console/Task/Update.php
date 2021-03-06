<?php

namespace App\Http\Controllers\Console\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Task;

class Update extends Controller
{
    public function __invoke(Request $request)
    {
        $task = Task::first();
        if( empty( $task ) ){
            Task::create([
                'tasks' => $request->tasks
            ]);
        }else{
            $task->tasks = $request->tasks;
            $task->save();
        }

        session()->flash('task-updated');

        return back();
    }
}
