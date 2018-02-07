<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marketer_company extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marketer_company';

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
 
 
    protected $fillable = ['user_id' , 'company_name' , 'logo' , 'website' , 'description'];
    
    // public function ImageDesc(){
    //     return $this->hasMany('App\Image_order');
    // }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
}
