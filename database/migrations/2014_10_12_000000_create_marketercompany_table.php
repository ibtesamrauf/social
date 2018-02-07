<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketercompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('marketer_company')){
            Schema::create('marketer_company', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('company_name');
                $table->string('logo' , 500);
                $table->string('website');
                $table->string('description' , 2000);
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
        Schema::dropIfExists('marketer_company');
    }
}
