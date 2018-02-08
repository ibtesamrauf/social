<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_preferred_medium extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_preferred_medium';

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
 
 
    protected $fillable = ['user_id' , 'preferred_medium_id'];
    
    public function Preferred_medium_data(){
        return $this->hasMany('App\Preferred_medium' , 'id' , 'preferred_medium_id');
    }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
}
