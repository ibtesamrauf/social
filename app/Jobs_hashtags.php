<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs_hashtags extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jobs_hashtags';

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
 
 
    protected $fillable = ['jobs_id' , 'hashtags_id'];
    
    public function belonto_jobs_data_hashtags(){
        return $this->hasOne('App\Jobs' , 'id' , 'jobs_id');
    }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
}
