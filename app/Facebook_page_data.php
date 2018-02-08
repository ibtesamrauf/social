<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facebook_page_data extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facebook_page_data';

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
 
 
    protected $fillable = ['user_id' , 'page_id', 'name' , 'link' , 'keyword' , 'likes' , 'image'];
    
    public function User_details(){
        return $this->hasOne('App\User' , 'id' , 'user_id');
    }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
}
