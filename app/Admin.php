<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Hashtags;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = 'admins';


    protected $fillable = [
        'first_name', 'last_name' ,'email','phone_number' , 'country' , 
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

    // public function Users_Roles_hashtags(){
    //     return $this->hasMany('App\User_roles_hashtags');
    // }

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
