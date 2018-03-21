<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobspreferredmediumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('jobs_preferred_medium')){
            Schema::create('jobs_preferred_medium', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('jobs_id');
                $table->integer('preferred_medium_id');
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
        Schema::dropIfExists('jobs_preferred_medium');
    }
}
