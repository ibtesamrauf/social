<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserpageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('user_page')){
            Schema::create('user_page', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('page_title');
                $table->string('page_description', 500);
                $table->string('page_about_your_self', 500);
                $table->string('facebook_pagr_url');
                $table->string('youtube_pagr_url');
                $table->string('instagram_pagr_url');
                // $table->rememberToken();
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
        Schema::dropIfExists('user_page');
    }
}
