<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYoutubepagedataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('youtube_page_data')){
            Schema::create('youtube_page_data', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->integer('page_id');
                $table->string('name');
                $table->string('keyword');
                $table->integer('subscriberCount' , 255);
                $table->string('image', 500);
                $table->string('description', 2000);
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
        Schema::dropIfExists('youtube_page_data');
    }
}
