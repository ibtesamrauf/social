<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketerpreviouslycampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('marketer_previously_campaign')){
            Schema::create('marketer_previously_campaign', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('influencer_used');
                $table->string('campaign_link');
                $table->string('description');
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
        Schema::dropIfExists('marketer_previously_campaign');
    }
}
