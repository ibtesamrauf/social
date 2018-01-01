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
 
 
    protected $fillable = ['user_id', 'page_title', 'page_description', 'page_about_your_self'];
    
    public function Users(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
}
