<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Hashtags;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_role', 'company_name', 'email', 'password','verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Users_Roles_hashtags(){
        return $this->hasMany('App\Roles_hashtags');
    }
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
