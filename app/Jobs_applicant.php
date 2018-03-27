<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs_applicant extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jobs_applicant';

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
 
 
    protected $fillable = ['jobs_id' , 'applicant_id' , 'applicant_name' , 'applicant_description'];
    
    public function belonto_jobs_data_hashtags(){
        return $this->hasOne('App\Jobs' , 'id' , 'jobs_id');
    }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
}
