<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Twitter_page_data extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'twitter_page_data';

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
    // name = for name
    // followers_count = followers count
    // statuses_count = tweeks count
    // friends_count = following
    // favourites_count = likes
    // profile_image_url_https = profile image
 
    protected $fillable = ['user_id' , 'name' , 'keyword' , 'followers_count' , 'statuses_count' , 'friends_count'
    ,'favourites_count' , 'image'];
    
    public function User_details_2(){
        return $this->hasOne('App\User' , 'id' , 'user_id');
    }

    // public function ImageDesc(){
    //     return $this->hasMany('App\Image_order');
    // }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
}
