<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Hashtags;
use Cmgmyr\Messenger\Traits\Messagable;

class User extends Authenticatable
{
    use Notifiable;
    use Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = 'users';

    protected $fillable = [
        'first_name', 'last_name' , 'profile_picture' , 'user_role', 'company_name', 'company_id', 'email', 'phone_number', 'country',
        'title', 'faebook_url', 'instagram_url', 'youtube_url', 'twitter_url', 
        'soundcloud_url', 'website_blog', 'monthly_visitors',
        'password','verified',
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
        return $this->hasMany('App\User_roles_hashtags');
    }

    public function Users_preferred_medium(){
        return $this->hasMany('App\User_preferred_medium' , 'user_id' , 'id');
    }
    
    public function Users_portfolio(){
        return $this->hasMany('App\User_portfolio');
    }
    
    public function User_previously_campaign(){
        return $this->hasMany('App\User_previously_campaign');
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
