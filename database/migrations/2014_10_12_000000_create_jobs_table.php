<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('jobs')){
            Schema::create('jobs', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('title');
                $table->string('description' , 500);
                $table->string('timing');
                $table->string('audience_all');
                $table->string('audience_facebook');
                $table->string('audience_instagram');
                $table->string('audience_youtube');
                $table->string('audience_twitter');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
