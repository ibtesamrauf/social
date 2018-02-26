<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Hashtags;
use Cmgmyr\Messenger\Traits\Messagable;

class Admin extends Authenticatable
{
    use Notifiable;
    use Messagable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = 'admins';


    protected $fillable = [
        'first_name', 'last_name', 'profile_picture' ,'email' ,'phone_number' , 'country' , 
        'password' ,'remember_token','verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Country_name(){
        return $this->hasOne('App\Country' , 'id' , 'country');
    }

    public function Maeketer_company(){
        return $this->hasOne('App\Marketer_company' , 'user_id' , 'id');
    }

    public function Maeketer_previously_campaign(){
        return $this->hasMany('App\Marketer_previously_campaign' , 'user_id' , 'id');
    }
    // public function Users_preferred_medium(){
    //     return $this->hasMany('App\User_preferred_medium');
    // }
    // public function Users_Roles_hashtags_names(){
    //     $temp = $this->hasMany('App\Roles_hashtags');
    //     $hashtags_data = array();
    //     // vv($temp);
    //     $zz = "";
    //     foreach ($temp as $key => $value) {
    //     //     v($value);
    //         $hashtags_data = $value; 
    //     $zz = Hashtags::select('tags')->where('id' , $value->hashtags_id);
    //     }
    //     v($hashtags_data);
    //     // vv($hashtags_data);
    //     // $object = new stdClass;
    //     // return $object;
    //     return $zz;
    //     // return $temp; 
    // }
}
