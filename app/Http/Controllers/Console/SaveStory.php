<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, Storage;

use App\Models\Story;
use App\Models\StoryQuestion;
use App\Models\StoryQuestionAnswer;

class SaveStory extends Controller
{
    public function __invoke(Request $request)
    {
        $story = new Story([
            'title' => $request->title,
            'body' => $request->body,
            'audio' => '',
            'cover_photo' => '',
            'created_by' => Auth::user()->id
        ]);
        $story->save();

        if ($request->has('recording')) {
            $audio_file = $request->file('recording');
            $audio_savepath = "audios/";

            $audio_url = Storage::disk('public')->put($audio_savepath, $audio_file);

            $story->audio = $audio_url;
            $story->save();
        }

        if ($request->has('cover_photo')) {
            $cover_photo_file = $request->file('cover_photo');
            $cover_photo_savepath = "cover_photos/";

            $cover_photo_url = Storage::disk('public')->put($cover_photo_savepath, $cover_photo_file);

            $story->cover_photo = $cover_photo_url;
            $story->save();
        }

        
        if( isset( $request->question ) ){
            foreach($request->question as $q){
                
                $question = new StoryQuestion([
                    'stories_id' => $story->id,
                    'question' => $q['question']
                ]);
                $question->save();
                
                $index = 1;
                foreach($q['choices'] as $answer){

                    $correct = 0;
                    if( $q['correct'] == $index ){
                        $correct = 1;
                    }

                    $choice = new StoryQuestionAnswer([
                        'story_questions_id' => $question->id,
                        'answer' => $answer,
                        'is_correct' => $correct
                    ]);
                    $choice->save();

                    $index++;
                }
                
            }
        }

        return redirect()->route('stories.list');
    }
}
