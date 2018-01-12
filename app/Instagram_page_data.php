<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instagram_page_data extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'instagram_page_data';

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
 
 
    protected $fillable = ['user_id' , 'page_id', 'name' , 'followed_by' , 'follows' , 'image'];
    
    // public function ImageDesc(){
    //     return $this->hasMany('App\Image_order');
    // }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
}
