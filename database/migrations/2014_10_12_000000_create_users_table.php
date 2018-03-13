<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')){
            Schema::create('users', function (Blueprint $table) {
                if(!Schema::hasColumn('users', 'id'))
                {
                    $table->increments('id');
                }
                if(!Schema::hasColumn('users', 'first_name'))
                {
                    $table->string('first_name');   
                }
                if(!Schema::hasColumn('users', 'last_name'))
                {
                    $table->string('last_name');
                }
                if(!Schema::hasColumn('users', 'profile_picture'))
                {
                    $table->string('profile_picture' , 500);
                }
                if(!Schema::hasColumn('users', 'user_role'))
                {
                    $table->string('user_role');
                }
                if(!Schema::hasColumn('users', 'company_name'))
                {
                    $table->string('company_name');
                }
                if(!Schema::hasColumn('users', 'email'))
                {
                    $table->string('email', 200)->unique();
                }
                if(!Schema::hasColumn('users', 'company_id'))
                {
                    $table->integer('company_id');   
                }
                if(!Schema::hasColumn('users', 'phone_number'))
                {
                    $table->string('phone_number');
                }
                if(!Schema::hasColumn('users', 'country'))
                {
                    $table->string('country');
                }
                if(!Schema::hasColumn('users', 'title'))
                {
                    $table->string('title');
                }
                if(!Schema::hasColumn('users', 'faebook_url'))
                {
                    $table->string('faebook_url');
                }
                if(!Schema::hasColumn('users', 'instagram_url'))
                {
                    $table->string('instagram_url');
                }
                if(!Schema::hasColumn('users', 'youtube_url'))
                {
                    $table->string('youtube_url');
                }
                if(!Schema::hasColumn('users', 'twitter_url'))
                {
                    $table->string('twitter_url');
                }
                if(!Schema::hasColumn('users', 'soundcloud_url'))
                {
                    $table->string('soundcloud_url');
                }
                if(!Schema::hasColumn('users', 'website_blog'))
                {
                    $table->string('website_blog');
                }
                if(!Schema::hasColumn('users', 'monthly_visitors'))
                {
                    $table->string('monthly_visitors');
                }
                if(!Schema::hasColumn('users', 'password'))
                {
                    $table->string('password');   
                }
                if(!Schema::hasColumn('users', 'provider'))
                {
                    $table->string('provider');
                }

                if(!Schema::hasColumn('users', 'provider_id'))
                {
                    $table->string('provider_id');
                }
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
        Schema::dropIfExists('users');
    }
}
