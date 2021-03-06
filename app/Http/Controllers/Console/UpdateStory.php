<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Story;
use App\Models\StoryQuestion;
use App\Models\StoryQuestionAnswer;

use Storage;

class UpdateStory extends Controller
{
    public function __invoke(Request $request, Story $story)
    {
        $story->title = $request->title;
        $story->body = $request->body;
        $story->save();

        if ($request->has('recording')) {
            $file = $request->file('recording');
            $extension = $file->getClientOriginalExtension();

            $filename = "story-" . $story->id . "." . $extension;
            $savepath = "public/audios/";

            $url = $savepath . $filename;
            Storage::putFileAs($savepath, $file, $filename, 'public');

            $story->audio = $url;
            $story->save();
        }

        if ($request->has('cover_photo')) {
            $cover_photo_file = $request->file('cover_photo');
            $cover_photo_extension = $cover_photo_file->getClientOriginalExtension();

            $cover_photo_filename = "story-" . $story->id . "." . $cover_photo_extension;
            $cover_photo_savepath = "public/cover_photo/";

            $url = $cover_photo_savepath . $cover_photo_filename;
            Storage::putFileAs($cover_photo_savepath, $cover_photo_file, $cover_photo_filename, 'public');

            $story->cover_photo = $url;
            $story->save();
        }

        if( isset( $request->question ) ){
            foreach ($request->question as $nquestion) {

                if( isset($nquestion['removed']) && trim( $nquestion['removed'] ) == "yes" ){
                    StoryQuestion::find( intval($nquestion['question_id']) )->delete();
                    continue;
                }

                if( isset( $nquestion['question_id'] ) ){ # Update Question
                    $question = StoryQuestion::find($nquestion['question_id']);

                    if (empty($question)) {
                        continue;
                    }

                    $question->question = $nquestion['question'];
                    $question->save();

                    $index = 1;
                    $choices = $nquestion['choices'];
                    foreach ($choices as $cid => $answer) {

                        $correct = 0;
                        if ($nquestion['correct'] == $index) {
                            $correct = 1;
                        }

                        $choice = StoryQuestionAnswer::find($cid);
                        $choice->answer = $answer;
                        $choice->is_correct = $correct;
                        $choice->save();

                        $index++;
                    }
                }else{ # Add Question
                    $question = new StoryQuestion([
                            'stories_id' => $story->id,
                            'question' => $nquestion['question']
                        ]);
                    $question->save();

                    $index = 1;
                    foreach ($nquestion['choices'] as $answer) {

                        $correct = 0;
                        if ($nquestion['correct'] == $index) {
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
        }

        return back();
        return redirect()->route('stories.list');
    }
}
