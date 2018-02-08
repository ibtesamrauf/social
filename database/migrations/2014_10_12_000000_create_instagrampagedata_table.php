<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstagrampagedataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('instagram_page_data')){
            Schema::create('instagram_page_data', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->integer('page_id');
                $table->string('name');
                $table->string('keyword');
                $table->integer('followed_by');
                $table->integer('follows');
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
        Schema::dropIfExists('instagram_page_data');
    }
}
