<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs_preferred_medium extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jobs_preferred_medium';

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
 
 
    protected $fillable = ['jobs_id' , 'preferred_medium_id'];
    
    public function belonto_jobs_data(){
        return $this->hasOne('App\Jobs' , 'id' , 'user_id');
    }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
}
