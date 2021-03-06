<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizRetakeCount extends Model
{
    protected $fillable = ["story_id", "user_id", "retake_count"];
    protected $table = "quiz_retake_count";
}
