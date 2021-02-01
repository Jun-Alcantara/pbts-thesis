<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryQuestion extends Model
{
    protected $fillable = ['stories_id', 'question'];

    public function MultipleChoices()
    {
        return $this->hasMany(\App\Models\StoryQuestionAnswer::class, "story_questions_id");
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($question) {
            $question->MultipleChoices()->delete();
        });
    }
}
