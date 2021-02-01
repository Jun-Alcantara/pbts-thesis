<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $fillable = ['user_id', 'story_id', 'points', 'number_of_question', 'duration'];

    public function QuizAnswer()
    {
        return $this->hasMany( \App\Models\QuizAnswer::class );
    }
}
