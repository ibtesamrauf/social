<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marketer_previously_campaign extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marketer_previously_campaign';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';    

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
 
 
    protected $fillable = ['user_id' , 'influencer_used', 'campaign_link', 'description' ];
    
    // public function ImageDesc(){
    //     return $this->hasMany('App\Image_order');
    // }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
}
