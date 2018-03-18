<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwitterpagedataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('twitter_page_data')){
            Schema::create('twitter_page_data', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('name');
                $table->integer('followers_count');
                $table->integer('statuses_count');
                $table->integer('friends_count');
                $table->integer('favourites_count');
                $table->string('keyword');
                $table->string('image', 500);
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
        Schema::dropIfExists('twitter_page_data');
    }
}
