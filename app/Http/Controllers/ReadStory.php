<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\StoryQuestionAnswer;
use App\Models\QuizResult;
use App\Models\QuizAnswer;
use App\Models\StoryQuestion;
use Auth, DB;

class ReadStory extends Controller
{
    public function read(Story $story)
    {
        $data['story'] = $story;
        $data['quiz_status']  = "";

        $quizes = QuizResult::where('user_id', Auth::user()->id)->where('story_id', $story->id)->first();

        if( $quizes ){
            $data['quiz_status'] = "done";
        }

        return view('read-story', $data);
    }

    public function quiz(Story $story)
    {
        $data['questions'] = $story->Questions;
        $data['story'] = $story;
        return view('quiz', $data);
    }

    public function assess(Request $request, Story $story)
    {
        $answers = $request->answer;
        $quiz_answers = [];

        $points = 0;

        foreach($answers as $question_id => $a){
            $correct_answer = StoryQuestionAnswer::where('story_questions_id', $question_id)->where('is_correct', 1)->first();

            if( intval($a) == $correct_answer->id ){
                $points += 1;
            }

            $quiz_answers[] = [
                'story_question_id' => $question_id,
                'user_answer' => $a
            ];
        }

        DB::transaction(function() use ($story, $request, $quiz_answers, $points){

            $quiz_result = new QuizResult([
                'user_id' => Auth::user()->id ?? 0,
                'story_id' => $story->id,
                'points' => $points,
                'number_of_question' => 0,
                'duration' => $request->time
            ]);
            $quiz_result->save();

            foreach ($quiz_answers as $qa) {
                $quiz_answer = new QuizAnswer([
                    'quiz_result_id' => $quiz_result->id,
                    'story_question_id' => $qa['story_question_id'],
                    'user_answer' => $qa['user_answer']
                ]);
                $quiz_answer->save();
            }

        });

        return redirect()->route('story.quiz.result', $story->id);
    }

    public function result(Story $story)
    {
        $data['story'] = $story;
        $data['questions'] = StoryQuestion::where('stories_id', $story->id)
                        ->select('story_questions.id', 'question', 'points', 'user_answer')
                        ->join('quiz_results as qr', 'qr.story_id', 'story_questions.stories_id')
                        ->join('quiz_answers as qa', function($join){
                            $join->on('qa.quiz_result_id', 'qr.id')
                                ->on('story_questions.id', 'qa.story_question_id');
                        })
                        ->get();

        $data['result'] = QuizResult::where('user_id', Auth::user()->id)->where('story_id', $story->id)->first();
        
        return view('quiz-results', $data);
    }  
}
