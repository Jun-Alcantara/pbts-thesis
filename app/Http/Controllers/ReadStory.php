<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\StoryQuestionAnswer;
use App\Models\QuizResult;
use App\Models\QuizAnswer;
use App\Models\StoryQuestion;
use App\Models\QuizRetakeCount;
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
        if( !isset( $request->answer ) ) return back();

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
                'number_of_question' => count($story->Questions),
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

        $data['result'] = $result = QuizResult::where('user_id', Auth::user()->id)->where('story_id', $story->id)->first();

        $questions = StoryQuestion::select('id', 'question')->where('stories_id', $story->id)->get();
        $data['questions'] = $questions->each(function($question) use ($result){

            $user_answer = QuizAnswer::where('quiz_result_id', $result->id)->where('story_question_id', $question->id)->first();
            if( !$user_answer ){
                return $question->answer = null;
            }

            return $question->user_answer = $user_answer->user_answer;

        });

        $data['retake_count'] = 2;
        $retake = QuizRetakeCount::where('story_id', $story->id)
                    ->where('user_id', Auth::user()->id)
                    ->first();
        
        if( !empty( $retake ) ){
            $data['retake_count'] = $retake->retake_count ?? 0;
        }
        
        return view('quiz-results', $data);
    }

    public function retake(Story $story)
    {
        DB::transaction(function() use ($story){
            $quiz_result = QuizResult::where('story_id', $story->id)
                ->where('user_id', \Auth::user()->id)
                ->first();

            $quiz_ans = QuizAnswer::where('quiz_result_id', $quiz_result->id)->delete();

            QuizResult::where('story_id', $story->id)
                ->where('user_id', Auth::user()->id)->delete();

            $retake = QuizRetakeCount::where('story_id', $story->id)
                            ->where('user_id', Auth::user()->id)
                            ->first();

            if( empty( $retake ) ){
                $retake = QuizRetakeCount::create([
                    'user_id' => Auth::user()->id,
                    'story_id' => $story->id,
                    'retake_count' => 2
                ]);
            }

            $retake->retake_count = intval($retake->retake_count) - 1;

            $retake->save();
        });

        return redirect()->route('story.quiz', $story->id);
    }
}
