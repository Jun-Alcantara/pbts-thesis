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
}
