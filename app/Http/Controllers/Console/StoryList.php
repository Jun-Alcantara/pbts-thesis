<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;

use App\Models\Story;

class StoryList extends Controller
{
    public function __invoke()
    {
        $data['active_tab'] = "stories";
        $data['stories'] = Story::all();
        return view('console.stories.list', $data);
    }
}
