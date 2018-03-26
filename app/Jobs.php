<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jobs';

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
 
 
    protected $fillable = ['user_id' , 'title' , 'description' , 'timing' , 'audience_all' , 
                            'audience_facebook', 'audience_instagram', 'audience_youtube', 'audience_twitter'];
    
    public function users_data(){
        return $this->hasOne('App\User' , 'id' , 'user_id');
    }
    
    public function jobs_preferred_medium(){
        return $this->hasMany('App\Jobs_preferred_medium', 'jobs_id' , 'id');
    }

    public function jobs_hashtags(){
        return $this->hasMany('App\Jobs_hashtags', 'jobs_id' , 'id');
    }
}
