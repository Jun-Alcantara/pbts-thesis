<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

class Story extends Model
{
    protected $fillable = ['title', 'body', 'audio', 'cover_photo', 'created_by'];

    use SoftDeletes;

    public function getAuthorAttribute($value)
    {
        return optional(User::find($this->created_by))->name;
    }

    public function Questions()
    {
        return $this->hasMany( \App\Models\StoryQuestion::class, "stories_id", "id" );
    }
}
