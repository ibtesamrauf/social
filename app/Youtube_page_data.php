<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Youtube_page_data extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'youtube_page_data';

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
 
 
    protected $fillable = ['user_id' , 'page_id', 'name' ,'keyword', 'subscriberCount' , 'image' , 'description'];
    
    public function User_details_3(){
        return $this->hasOne('App\User' , 'id' , 'user_id');
    }

    // public function ImageDesc(){
    //     return $this->hasMany('App\Image_order');
    // }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
}
