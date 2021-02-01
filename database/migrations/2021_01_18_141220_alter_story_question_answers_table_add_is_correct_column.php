<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStoryQuestionAnswersTableAddIsCorrectColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('story_question_answers', function (Blueprint $table) {
            $table->tinyInteger('is_correct')->after('answer')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('story_question_answers', function (Blueprint $table) {
            //
        });
    }
}
