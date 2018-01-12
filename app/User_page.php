<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_page extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_page';

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
 
 
    protected $fillable = ['user_id', 'page_title', 'page_description', 'page_about_your_self' , 'facebook_page_url' , 'youtube_page_url' , 'instagram_page_url'];
    
    public function Users(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function Facebook_page(){
        return $this->hasMany('App\Facebook_page_data', 'page_id', 'id');
    }

    public function Youtube_page(){
        return $this->hasMany('App\Youtube_page_data', 'page_id', 'id');
    }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
}
