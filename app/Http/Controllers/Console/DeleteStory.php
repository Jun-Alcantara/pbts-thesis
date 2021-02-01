<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;

use App\Models\Story;

class DeleteStory extends Controller
{
    public function __invoke(Story $story)
    {
        $story->delete();

        session()->flash('story_deleted', $story->title . " deleted.");
        return back();
    }
}
