<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Story;

class EditStory extends Controller
{
    public function __invoke(Story $story)
    {
        $data['active_tab'] = "stories";
        $data['story'] = $story;
        return view('console.stories.edit', $data);
    }
}
