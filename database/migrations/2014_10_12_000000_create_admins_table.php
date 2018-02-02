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
                // $table->string('profile_picture' , 500);
                // $table->string('user_role');
                // $table->string('company_name');
                $table->string('email', 200)->unique();
                // $table->integer('company_id');
                $table->string('phone_number');
                $table->string('country');
                // $table->string('title');
                // $table->string('faebook_url');
                // $table->string('instagram_url');
                // $table->string('youtube_url');
                // $table->string('twitter_url');
                // $table->string('soundcloud_url');
                // $table->string('website_blog');
                // $table->string('monthly_visitors');
                
                
                $table->tinyInteger('verified')->default(0);
                $table->string('verification_token')->nullable();

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