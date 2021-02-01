<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryQuestionAnswer extends Model
{
    protected $fillable = ['story_questions_id', 'answer', 'is_correct'];
}
