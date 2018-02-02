<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacebookpagedataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('facebook_page_data')){
            Schema::create('facebook_page_data', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->integer('page_id');
                $table->string('name');
                $table->string('link');
                $table->string('likes');
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
        Schema::dropIfExists('facebook_page_data');
    }
}
