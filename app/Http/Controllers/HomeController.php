<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\QuizResult;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['stories'] = $story = Story::all();

        return view('home', $data);
    }

    public function home()
    {
        return view('main');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function library()
    {
        $data['stories'] = $story = Story::all();
        return view('library', $data);
    }

    public function task()
    {
        $data['tasks'] = \App\Models\Task::first();

        return view('task', $data);
    }

    public function settings()
    {
        $data['user'] = Auth::user();
        return view('settings', $data);
    }

    public function about()
    {
        $data['aboutus'] = null;

        $aboutus = \App\Models\AboutUs::first();
        if( $aboutus ){
            $data['aboutus'] = $aboutus->about_us;
        }

        return view('about', $data);
    }

    public function stars()
    {
        $results = [];

        $quiz_results = QuizResult::where('user_id', Auth::user()->id)->get();

        foreach($quiz_results as $qr){
            $story = Story::find( $qr->story_id );
            if( empty( $story ) ) continue;

            $story_result = [];
            $story_result['id'] = $story->id;
            $story_result['title'] = $story->title;
            $story_result['cover_photo'] = $story->cover_photo;
            $story_result['total_questions'] = count($story->Questions);
            $story_result['points'] = $qr->points;
            $story_result['duration'] = $qr->duration;
            $story_result['created_at'] = $qr->created_at;

            $results[] = $story_result;
        }



        $data['results'] = $results;

        return view('stars', $data);
    }
}
