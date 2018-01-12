<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles_hashtags extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles_hashtags';

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
 
 
    protected $fillable = ['user_id' , 'hashtags_id' ];
    
    // public function ImageDesc(){
    //     return $this->hasMany('App\Image_order');
    // }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
}
