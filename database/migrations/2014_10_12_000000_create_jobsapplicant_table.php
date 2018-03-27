<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsapplicantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('jobs_applicant')){
            Schema::create('jobs_applicant', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('jobs_id');
                $table->integer('applicant_id');
                $table->string('applicant_name');
                $table->string('applicant_description');
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
        Schema::dropIfExists('jobs_applicant');
    }
}
