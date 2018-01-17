<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preferred_medium extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'preferred_medium';

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
 
 
    protected $fillable = ['preferred_medium_title'];
    
    // public function ImageDesc(){
    //     return $this->hasMany('App\Image_order');
    // }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
}
