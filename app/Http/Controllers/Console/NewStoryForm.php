<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;

class NewStoryForm extends Controller
{
    public function __invoke()
    {
        $data['active_tab'] = "stories";
        return view('console.stories.new');
    }
}
