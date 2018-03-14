<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('admins')){
            Schema::create('admins', function (Blueprint $table) {
                $table->increments('id');
                $table->string('first_name');   
                $table->string('last_name');
                $table->string('profile_picture' , 500);
                $table->string('email', 200)->unique();
                $table->string('phone_number');
                $table->string('country');    
                $table->tinyInteger('verified')->default(0);
                $table->string('verification_token')->nullable();
                $table->string('provider');
                $table->string('provider_id');
                $table->string('password');
                $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
