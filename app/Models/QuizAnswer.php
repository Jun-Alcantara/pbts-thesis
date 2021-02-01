<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $fillable = ['quiz_result_id', 'story_question_id', 'user_answer'];
}
